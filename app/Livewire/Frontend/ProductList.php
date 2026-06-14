<?php

namespace App\Livewire\Frontend;

use App\Models\Products\Brand;
use App\Models\Products\Product;
use App\Models\Products\ProductCategory;
use App\Support\SeoMetadata;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public string $activeBrandName = '';

    #[Url(as: 'product', except: null)]
    public ?string $productSlug = null;

    #[Url(as: 'brand', except: null, keep: true)]
    public ?string $activeBrand = null;

    #[Url(as: 'category', except: ['all', null, ''])]
    public ?string $activeCategory = 'all';

    #[Url(except: '')]
    public string $keyword = '';

    public function updating($property)
    {
        if (in_array($property, ['activeBrand', 'activeCategory', 'keyword'])) {
            $this->resetPage();
            $this->animateProductList();
        }
    }

    public function updatedPage($page)
    {
        $this->animateProductList();
    }

    private function setMetaData(): void
    {
        $this->activeBrandName = $this->activeBrandModel()?->name ?? '';
        $title = trim(__('seo.products.title').' '.$this->activeBrandName);

        SeoMetadata::register(
            title: $title,
            description: __('seo.products.description'),
            url: route('product', array_filter(['product' => $this->productSlug])),
            image: asset('img/mutu.jpg'),
        );
    }

    private function updateTitle(): void
    {
        $title = trim(__('seo.products.title').' '.$this->activeBrandName).' - '.config('app.name');
        $this->dispatch('update-page-title', title: $title);
    }

    private function animateProductList()
    {
        $this->dispatch('animate-product-list');
    }

    public function mount(): void
    {
        $firstBrand = $this->brands->first();

        if (! request('brand') && $firstBrand) {
            $this->activeBrand = $firstBrand->slug;
        }

        $this->setMetaData();
        $this->updateTitle();
    }

    public function handleChangeActiveBrand($slug)
    {
        $this->activeBrand = $slug;
        $this->activeBrandName = $this->activeBrandModel()?->name ?? '';
        $this->reset('activeCategory');
        $this->updateTitle();
        $this->animateProductList();

        $this->resetPage();
    }

    public function handleChangeActiveProduct(string $slug = '')
    {
        if (! $slug) {
            $this->reset('productSlug');
        } else {
            $this->productSlug = $slug;
        }
    }

    public function updatedActiveCategory()
    {
        $this->resetPage();
    }

    #[Computed]
    public function brands()
    {
        $brands = Brand::query()
            ->forProductCatalog()
            ->get();

        $categoriesByBrand = ProductCategory::query()
            ->forProductCatalog()
            ->get()
            ->groupBy('brand_id');

        return $brands->each(function (Brand $brand) use ($categoriesByBrand): void {
            $brand->setRelation('uniqueCategories', $categoriesByBrand
                ->get($brand->id, collect())
                ->unique('id')
                ->values());
        });
    }

    public function render()
    {
        $activeBrand = $this->activeBrandModel();
        $keyword = trim($this->keyword);

        $products = Product::query()
            ->forCatalogListing()
            ->when(
                $this->activeBrand,
                fn (Builder $query) => $query->forBrand($activeBrand?->id),
            )
            ->when(
                $this->activeCategory !== 'all',
                fn (Builder $query) => $query->whereHas(
                    'categories',
                    fn (Builder $categoryQuery) => $categoryQuery->where('slug', $this->activeCategory),
                ),
            )
            ->searchCatalogName($keyword)
            ->orderBy('order_column')
            ->paginate(6);

        if ($activeBrand) {
            $products->getCollection()->each(
                fn (Product $product) => $product->setRelation('brand', $activeBrand),
            );
        }

        return view('livewire.product-list', [
            'products' => $products,
            'activeProduct' => $this->activeProduct(),
        ]);
    }

    private function activeBrandModel(): ?Brand
    {
        return $this->brands->firstWhere('slug', $this->activeBrand);
    }

    private function activeProduct(): ?Product
    {
        if (! $this->productSlug) {
            return null;
        }

        $product = Product::findBySlug(
            $this->productSlug,
            additionalQuery: fn (Builder $query) => $query->with([
                'media' => fn ($mediaQuery) => $mediaQuery->where('collection_name', 'packaging'),
                'categories:id,name,slug',
            ]),
        );

        if ($product && $brand = $this->brands->firstWhere('id', $product->brand_id)) {
            $product->setRelation('brand', $brand);
        }

        return $product;
    }
}

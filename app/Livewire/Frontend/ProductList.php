<?php

namespace App\Livewire\Frontend;

use App\Models\Products\Brand;
use App\Models\Products\Product;
use App\Models\Products\ProductCategory;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $brands;

    public $allCategories;

    public $activeBrandName;

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
            $this->animateProductList();
        }
    }

    public function updatedPage($page)
    {
        $this->animateProductList();
    }

    private function handleArrayDiffing(string $value, array &$array)
    {
        if (! in_array($value, $array)) {
            $array = array_merge($array, [$value]);
        } else {
            $array = array_diff($array, [$value]);
        }
        $this->resetPage();
    }

    private function setMetaData()
    {
        $og = new OpenGraphPackage('open graph');
        $twitter_card = new TwitterCardPackage('twitter');

        $this->activeBrandName = $this->brands->firstWhere('slug', $this->activeBrand)->name ?? '';

        $title = 'Products '.$this->activeBrandName.' - '.env('APP_NAME');
        $description = 'Temukan beragam olahan ikan frozen food halal di Cedea Seafood. Produk berkualitas tinggi yang praktis dan lezat untuk menu harian Anda.';
        $url = route('product');
        $image = asset('img/mutu.jpg');
        $locale = 'id_ID';
        $alternateLocale = 'en_US';

        Meta::setDescription($description);
        Meta::prependTitle('Products '.$this->activeBrandName);

        $og
            ->setType('website')
            ->setSiteName(env('APP_NAME'))
            ->setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image)
            ->setLocale($locale)
            ->addAlternateLocale($alternateLocale);

        $twitter_card
            ->setTitle($title)
            ->setDescription($description)
            ->setImage($image);

        Meta::registerPackage($og);
        Meta::registerPackage($twitter_card);

    }

    private function updateTitle()
    {
        $title = 'Products '.$this->activeBrandName.' - '.env('APP_NAME');
        $this->dispatch('update-page-title', title: $title);
    }

    private function animateProductList()
    {
        $this->dispatch('animate-product-list');
    }

    public function mount()
    {

        $this->allCategories = ProductCategory::all();
        $this->brands = Brand::orderBy('order_column')->with(['products.categories', 'media'])->get();

        if (! request('brand')) {
            if ($this->brands->first()) {
                $this->activeBrand = $this->brands->first()->slug;
            }
        }

        $this->setMetaData();
        $this->updateTitle();
    }

    public function handleChangeActiveBrand($slug)
    {
        $this->activeBrand = $slug;
        $this->activeBrandName = $this->brands->firstWhere('slug', $this->activeBrand)->name ?? '';
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

    #[Computed()]
    public function brandWithUniqueCategories()
    {
        foreach ($this->brands as $brand) {
            // Flatten the categories collections and get unique categories
            $uniqueCategories = $brand->products->pluck('categories')->flatten()->unique('id');

            // Now you have unique categories for the brand
            // You can assign it to the brand or use it as needed
            $brand->uniqueCategories = $uniqueCategories->sortBy('name');
        }

        return $this->brands;
    }

    public function render()
    {
        return view('livewire.product-list', [
            'products' => Product::with(['media', 'brand', 'categories'])
                ->when(
                    $this->activeBrand,
                    function ($q) {
                        return $q->whereRelation('brand', 'slug', $this->activeBrand);
                    }
                )
                ->when(
                    $this->activeCategory !== 'all',
                    function ($q) {
                        return $q->whereHas('categories', function (Builder $query) {
                            $query->where('slug', $this->activeCategory);
                        });
                    }
                )
                ->when(
                    $this->keyword,
                    function ($q) {
                        return $q->whereRaw('LOWER(name) like "%'.strtolower($this->keyword).'%"');
                    }
                )
                ->orderBy('order_column', 'asc')
                ->paginate(6),

            'activeProduct' => Product::findBySlug($this->productSlug ?? ''),

        ]);
    }
}

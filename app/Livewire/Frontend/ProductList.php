<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\Products\Brand;
use App\Models\Products\Product;
use App\Models\Products\Category;
use App\Models\Products\ProductCategory;
use Livewire\Attributes\Computed;
use Illuminate\Database\Eloquent\Builder;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;

class ProductList extends Component
{
    use WithPagination;

    public $brands;
    public $allCategories;
    public $activeProduct = null;

    #[Url(as: 'brand', except: null, keep: true)]
    public ?string $activeBrand = null;

    #[Url(as: 'category', except: ['all', null, ''], keep: true)]
    public ?string $activeCategory = 'all';

    #[Url(except: '')]
    public string $keyword = '';

    private function handleArrayDiffing(string $value, array &$array)
    {
        if (!in_array($value, $array)) {
            $array = array_merge($array, [$value]);
        } else {
            $array = array_diff($array, [$value]);
        }
        $this->resetPage();
    }

    public function mount()
    {

        $og = new OpenGraphPackage('open graph');
        $twitter_card = new TwitterCardPackage('twitter');

        $title = 'Products - ' . env('APP_NAME');
        $description = 'Jelajahi kekayaan laut dengan rangkaian produk terbaik dari CEDEA Seafood!';
        $url = route('product');
        $image = asset('img/mutu.jpg');
        $locale = 'id_ID';
        $alternateLocale = 'en_US';

        Meta::setDescription($description);
        Meta::prependTitle('Products');

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

        $this->allCategories = ProductCategory::all();
        $this->brands = Brand::orderBy('order_column')->with(['products.categories', 'media'])->get();;

        if (! request('brand')) {
            if ($this->brands->first()) {
                $this->activeBrand = $this->brands->first()->slug;
            }
        }
    }

    public function handleChangeActiveBrand($slug)
    {
        $this->activeBrand = $slug;

        $this->reset('activeCategory');
        $this->reset('activeProduct');
        $this->resetPage();
    }

    public function handleChangeActiveProduct(string $slug = '')
    {
        if (!$slug) {
            $this->reset('activeProduct');
        } else {
            $this->activeProduct = Product::where('slug', $slug)->first();
        }
    }

    public function updatedActiveCategory()
    {
        $this->resetPage();
    }

    #[Computed(persist: true, seconds: 120)]
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
                        return $q->whereRaw('LOWER(name) like "%' . strtolower($this->keyword) . '%"');
                    }
                )
                ->orderBy('order_column', 'asc')
                ->paginate(6),
        ]);
    }
}

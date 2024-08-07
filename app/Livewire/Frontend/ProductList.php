<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Models\Products\Brand;
use App\Models\Products\Product;
use App\Models\Products\Category;
use Livewire\Attributes\Computed;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $brands;
    public $allCategories;
    public $categories = [];
    public $activeProduct = null;

    #[Url(as: 'brand', except: [])]
    public array $activeBrands = [];

    #[Url(as: 'categories', except: [])]
    public array $activeCategories = [];

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

        $this->allCategories = Category::all();
    }

    public function handleChangeActiveBrands($slug)
    {
        $this->handleArrayDiffing($slug, $this->activeBrands);

        $this->reset('activeProduct');
    }

    public function handleChangeActiveCategories($slug)
    {
        $this->handleArrayDiffing($slug, $this->activeCategories);

        $this->reset('activeProduct');
    }

    public function handleChangeActiveProduct($slug)
    {
        $this->activeProduct = Product::where('slug', $slug)->first();
    }

    #[Computed]
    public function activeCategoriesName()
    {
        $categoriesName = [];
        $categoriesName = $this->allCategories->filter(function ($item) {
            return in_array($item->slug, $this->activeCategories);
        });
        return $categoriesName;
    }

    #[Computed]
    public function brandWithUniqueCategories()
    {
        $brands = Brand::orderBy('order_column')->get();

        foreach ($brands as $brand) {
            // Flatten the categories collections and get unique categories
            $uniqueCategories = $brand->products->pluck('categories')->flatten()->unique('id');

            // Now you have unique categories for the brand
            // You can assign it to the brand or use it as needed
            $brand->uniqueCategories = $uniqueCategories;
        }

        return $brands;
    }

    public function updating()
    {
        // TODO: exclude activeProductChange
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.frontend.product-list', [
            'products' => Product::query()
                ->when(
                    count($this->activeBrands),
                    function ($q) {
                        return $q->whereHas('brand', function (Builder $query) {
                            return $query->wherein('slug', $this->activeBrands);
                        });
                        // return $q->whereRelation('brand', 'slug', $this->activeBrands);
                    }
                )
                ->when(
                    count($this->activeCategories),
                    function ($q) {
                        return $q->whereHas('categories', function (Builder $query) {
                            $query->whereIn('slug', $this->activeCategories);
                        });
                    }
                )
                ->when(
                    $this->keyword,
                    function ($q) {
                        return $q->where('name', 'LIKE', '%' . $this->keyword . '%');
                    }
                )
                ->with(['media', 'brand.media', 'categories'])
                ->simplePaginate(1),
            'categories' => $this->categories,
        ]);
    }
}

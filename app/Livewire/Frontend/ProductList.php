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


    private function handleArrayDiffing($value, &$array)
    {
        if (!in_array($value, $array)) {
            array_push($array, $value);
        } else {
            $array  = array_diff($array, [$value]);
        }
    }

    public function mount()
    {
        $this->brands = Brand::orderBy('order_column')->with('media')->get();
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

    #[Computed]
    public function activeCategoriesName()
    {
        $categoriesName = [];
        $categoriesName = $this->allCategories->filter(function ($item) {
            return in_array($item->slug, $this->activeCategories);
        });
        return $categoriesName;
    }

    public function handleChangeActiveProduct($slug)
    {
        $this->activeProduct = Product::where('slug', $slug)->first();
    }

    #[Computed]
    public function brandWithUniqueCategories()
    {
        foreach ($this->brands as $brand) {
            // Flatten the categories collections and get unique categories
            $uniqueCategories = $brand->products->pluck('categories')->flatten()->unique('id');

            // Now you have unique categories for the brand
            // You can assign it to the brand or use it as needed
            $brand->uniqueCategories = $uniqueCategories;
        }

        return $this->brands;
    }

    public function updating()
    {
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
                ->with(['media', 'brand', 'categories'])
                ->simplePaginate(6),
            'categories' => $this->categories,
        ]);
    }
}

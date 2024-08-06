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


class ProductList extends Component
{
    public $brands;
    public $allCategories;
    public $categories = [];

    #[Url(as: 'brand', history: false, except: '')]
    public ?string $activeBrand = null;

    #[Url(as: 'categories', history: false, except: [])]
    public array $activeCategories = [];

    #[Url(as: 'keyword', history: false, except: '')]
    public ?string $keyword = null;

    public $activeCategoriesName = [];

    public $activeProduct = null;

    public function mount()
    {
        $this->brands = Brand::orderBy('order_column')->with('media')->get();
        $this->allCategories = Category::all();
    }

    public function handleChangeActiveBrand($slug)
    {
        if ($this->activeBrand === $slug) {
            $this->reset('activeBrand');
            $this->reset('activeCategories');
            $this->reset('activeCategoriesName');
        } else {
            $this->activeBrand = $slug;
        }

        $this->reset('activeProduct');
    }

    public function handleChangeActiveCategories($slug)
    {

        if (!in_array($slug, $this->activeCategories)) {
            array_push($this->activeCategories, $slug);
        } else {
            $this->activeCategories  = array_diff($this->activeCategories, [$slug]);
        }

        $this->activeCategoriesName = $this->allCategories->filter(function ($item) {
            return in_array($item->slug, $this->activeCategories);
        });

        $this->reset('activeProduct');
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

    public function render()
    {
        return view('livewire.frontend.product-list', [
            'products' => Product::query()
                ->when(
                    $this->activeBrand,
                    function ($q) {
                        return $q->whereRelation('brand', 'slug', $this->activeBrand);
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
                ->get(),
            'categories' => $this->categories,
        ]);
    }
}

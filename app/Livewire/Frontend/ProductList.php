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

    #[Url(as: 'brand', history: true, except: '')]
    public ?string $activeBrand = null;

    #[Url(as: 'category', history: true, except: '')]
    public array $activeCategories = [];

    public $products;

    public $activeProduct = null;

    public function mount($brands, $categories)
    {
        $this->brands = $brands;
        $this->allCategories = $categories;
        $this->getProducts();
    }

    public function handleChangeActiveBrand($slug)
    {
        $this->activeBrand = $slug;
        // $this->activeCategories = null;
        $this->reset('activeProduct');
        $this->getProducts();
    }

    public function handleChangeActiveCategories($slug)
    {
        // $this->activeCategories = $slug;

        if (!in_array($slug, $this->activeCategories)) {
            array_push($this->activeCategories, $slug);
        } else {
            $this->activeCategories  = array_diff($this->activeCategories, [$slug]);
        }

        $this->reset('activeProduct');
        $this->getProducts();
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

    public function getProducts()
    {
        $this->products = Product::query()
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
            ->with(['media', 'brand', 'categories'])
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.product-list', [
            'products' => $this->products,
            'categories' => $this->categories,
        ]);
    }
}

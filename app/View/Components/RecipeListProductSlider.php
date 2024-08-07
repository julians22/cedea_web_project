<?php

namespace App\View\Components;

use App\Models\Products\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecipeListProductSlider extends Component
{

    public $products;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->products = Product::inRandomOrder()->limit(20)->with('media')->get();
        if (!$this->products) {
            $this->products == collect();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.recipe-list-product-slider');
    }
}

<?php

namespace App\View\Components\Home;

use Closure;
use App\Models\Banner as ModelsBanner;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Banner extends Component
{
    public $banners;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->banners = ModelsBanner::with('media')->orderBy('order_column')->where('enable', true)->get();
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home.banner');
    }
}

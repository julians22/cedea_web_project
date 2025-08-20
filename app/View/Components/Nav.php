<?php

namespace App\View\Components;

use App\Enums\NewsType;
use App\Enums\RecipeType;
use App\Models\Products\Brand;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\View\Component;

class Nav extends Component
{
    public $nav_items;

    public $locale;

    public $brands;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->locale = App::currentLocale();

        $this->brands =
            Brand::query()->inNav()->orderBy('order_column')->get()->map(function ($brand) {
                return [
                    'label' => $brand->name,
                    'route' => route('product', [
                        'brand' => $brand->slug,
                    ]),
                    'submenu' => [],
                ];
            })->toArray();

        // * TYPE DOC
        // * [label : string
        // *     route : string | route
        // *     submenu: [
        // *         label : string
        // *         route : string | route
        // *         submenu: [
        // *             label : string
        // *             route : string | route
        // *         ][]
        // *     ][]
        // * ][]
        $this->nav_items = [
            [
                'label' => __('nav.company'),
                'route' => route('about'),
                'disable' => false,
                'submenu' => [
                    [
                        'label' => __('nav.company.brief'),
                        'route' => route('about', ['#sekilas-perusahaan']),
                        'submenu' => [],
                    ],
                    [
                        'label' => __('nav.company.history'),
                        'route' => route('about', ['#sejarah']),
                        'submenu' => [],
                    ],
                    [
                        'label' => __('nav.company.value'),
                        'route' => route('about', ['#visi-misi']),
                        'submenu' => [],
                    ],
                    [
                        'label' => __('nav.company.area'),
                        'route' => route('about', ['#wilayah']),
                        'submenu' => [],
                    ],
                ],
            ],
            [
                'label' => __('nav.product'),
                'route' => route('product'),
                'disable' => false,
                'submenu' => [
                    ...$this->brands,

                    [
                        'label' => 'Video',
                        'route' => route('videos'),
                        'submenu' => [],
                    ],

                    // [
                    //     'label' => 'Royalti Point',
                    //     'route' => '#',
                    //     'submenu' => []
                    // ],
                ],
            ],

            [
                'label' => __('nav.product.marketplace'),
                'route' => route('marketplace'),
                'disable' => false,
                'submenu' => [],
            ],

            [
                'label' => __('nav.recipe'),
                'route' => route('recipe'),
                // 'route' => '#',
                'disable' => false,
                'submenu' => [
                    [
                        'label' => __('meal.breakfast'),
                        'route' => route('recipe', ['type' => RecipeType::BREAKFAST->value]),
                    ],
                    [
                        'label' => __('meal.lunch'),
                        'route' => route('recipe', ['type' => RecipeType::LUNCH->value]),
                    ],
                    [
                        'label' => __('meal.dinner'),
                        'route' => route('recipe', ['type' => RecipeType::DINNER->value]),
                    ],
                    [
                        'label' => __('meal.snack'),
                        'route' => route('recipe', ['type' => RecipeType::SNACK->value]),
                    ],
                ],
            ],

            [
                'label' => __('nav.news'),
                'route' => route('news'),
                'disable' => false,
                'submenu' => [
                    [
                        'label' => __('nav.news.activity'),
                        'route' => route('news', ['type' => NewsType::ACTIVITY->value]),
                        'submenu' => [],
                    ],
                    [
                        'label' => __('nav.news.Artikel'),
                        'route' => route('news', ['type' => NewsType::ARTICLE->value]),
                        'submenu' => [],
                    ],
                ],
            ],
            [
                'label' => __('nav.contact'),
                'route' => route('contact'),
                'disable' => false,
                'submenu' => [],
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav');
    }
}

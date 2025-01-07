<?php

namespace App\View\Components;

use App\Enums\NewsType;
use App\Enums\RecipeType;
use App\Models\Products\Brand;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\View\Component;
use Spatie\Sitemap\Tags\News;

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
                        'brand' => $brand->slug
                    ]),
                    'submenu' => []
                ];
            })->toArray();


        //* TYPE DOC
        //* [label : string
        //*     route : string | route
        //*     submenu: [
        //*         label : string
        //*         route : string | route
        //*         submenu: [
        //*             label : string
        //*             route : string | route
        //*         ][]
        //*     ][]
        //* ][]
        $this->nav_items = [
            [
                'label' => __('nav.company'),
                'route' => route('about'),
                'disable' => false,
                'submenu' => [
                    [
                        'label' => __('nav.company.brief'),
                        'route' => route('about', ['#sekilas-perusahaan']),
                        'submenu' => []
                    ],
                    [
                        'label' => __('nav.company.history'),
                        'route' => route('about', ['#sejarah']),
                        'submenu' => []
                    ],
                    [
                        'label' => __('nav.company.value'),
                        'route' =>  route('about', ['#visi-misi']),
                        'submenu' => []
                    ],
                    [
                        'label' => __('nav.company.area'),
                        'route' => route('about', ['#wilayah']),
                        'submenu' => []
                    ],
                ]
            ],
            [
                'label' => __('nav.product'),
                'route' => route('product'),
                // 'route' => '#',
                'disable' => false,
                'submenu' => [
                    ...$this->brands,

                    // [
                    //     'label' => 'Video',
                    //     'route' => '#',
                    //     'submenu' => []
                    // ],
                    // [
                    //     'label' => 'Belanja',
                    //     'route' => route('marketplace'),
                    //     'submenu' => []
                    // ],
                    // [
                    //     'label' => 'Royalti Point',
                    //     'route' => '#',
                    //     'submenu' => []
                    // ],
                ]
            ],

            [
                'label' => __('nav.recipe'),
                'route' => route('recipe'),
                // 'route' => '#',
                'disable' => true,
                'submenu' => [
                    [
                        'label' => __('meal.breakfast'),
                        // 'route' => '#',
                        'route' => route('recipe', ['type' => RecipeType::BREAKFAST->value]),
                    ],
                    [
                        'label' => __('meal.lunch'),
                        // 'route' => '#',
                        'route' => route('recipe', ['type' => RecipeType::LUNCH->value]),
                    ],
                    [
                        'label' => __('meal.dinner'),
                        // 'route' => '#',
                        'route' => route('recipe', ['type' => RecipeType::DINNER->value]),
                    ],
                    [
                        'label' => __('meal.snack'),
                        // 'route' => '#',
                        'route' => route('recipe', ['type' => RecipeType::SNACK->value]),
                    ],
                ]
            ],

            [
                'label' => __('nav.news'),
                'route' => route('news'),
                'disable' => false,
                'submenu' => [
                    [
                        'label' => __('nav.news.activity'),
                        'route' => route('news', ['type' => NewsType::ACTIVITY->value]),
                        'submenu' => []
                    ],
                    [
                        'label' => __('nav.news.Artikel'),
                        'route' => route('news', ['type' => NewsType::ARTICLE->value]),
                        'submenu' => []
                    ],
                ]
            ],
            [
                'label' => __('nav.contact'),
                'route' => '#',
                // 'route' => route('contact'),
                'disable' => true,
                'submenu' => []
            ]
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

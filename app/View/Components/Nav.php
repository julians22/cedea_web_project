<?php

namespace App\View\Components;

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
                'disable' => false,
                'submenu' => [
                    [
                        'label' => __('meal.Sarapan'),
                        'route' => route('recipe', ['type' => 'sarapan']),
                    ],
                    [
                        'label' => __('meal.Makan Siang'),
                        'route' => route('recipe', ['type' => 'makan-siang']),
                    ],
                    [
                        'label' => __('meal.Makan Malam'),
                        'route' => route('recipe', ['type' => 'makan-malam']),
                    ],
                    [
                        'label' => __('meal.Snack'),
                        'route' => route('recipe', ['type' => 'snack']),
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
                        'route' => '#',
                        'submenu' => []
                    ],
                    [
                        'label' => __('nav.news.Artikel'),
                        'route' => '#',
                        'submenu' => []
                    ],
                ]
            ],
            [
                'label' => __('nav.contact'),
                'route' => route('contact'),
                'disable' => false,
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

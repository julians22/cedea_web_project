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
                        'label' => 'Sekilas perusahaan',
                        'route' => route('about', ['#sekilas-perusahaan']),
                        'submenu' => []
                    ],
                    [
                        'label' => 'Sejarah',
                        'route' => route('about', ['#sejarah']),
                        'submenu' => []
                    ],
                    [
                        'label' => 'Visi, Misi & Nilai Perusahaan',
                        'route' =>  route('about', ['#visi-misi']),
                        'submenu' => []
                    ],
                    [
                        'label' => 'Wilayah Kerja',
                        'route' => route('about', ['#wilayah']),
                        'submenu' => []
                    ],
                ]
            ],
            [
                'label' => 'Merek',
                'route' => route('product'),
                // 'route' => '#',
                'disable' => false,
                'submenu' => [
                    ...$this->brands,
                    [
                        'label' => 'Kreasi Resep',
                        'route' => route('recipe'),
                        'disable' => false,
                        'submenu' => [
                            [
                                'label' => 'Sarapan',
                                'route' => route('recipe', ['type' => 'sarapan']),
                            ],
                            [
                                'label' => 'Makan Siang',
                                'route' => route('recipe', ['type' => 'makan-siang']),
                            ],
                            [
                                'label' => 'Makan Malam',
                                'route' => route('recipe', ['type' => 'makan-malam']),
                            ],
                            [
                                'label' => 'Snack',
                                'route' => route('recipe', ['type' => 'snack']),
                            ],
                        ]
                    ],
                    // [
                    //     'label' => 'Video',
                    //     'route' => '#',
                    //     'submenu' => []
                    // ],
                    // [
                    //     'label' => 'Belanja',
                    //     'route' => '#',
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
                'label' => 'Tanggung Jawab Sosial',
                'route' => '#',
                'disable' => true,
                'submenu' => [
                    [
                        'label' => 'Kegiatan Sosial',
                        'route' => '#',
                        'submenu' => []
                    ],
                    [
                        'label' => 'Lingkungan Hidup',
                        'route' => '#',
                        'submenu' => []
                    ],
                    [
                        'label' => 'Ketenagakerjaan Kesehatan Dan Keselamatan Kerja',
                        'route' => '#',
                        'submenu' => []
                    ],
                    [
                        'label' => 'Pengembangan Sosial Dan Kemasyarakatan',
                        'route' => '#',
                        'submenu' => []
                    ],
                ]
            ],
            [
                'label' => 'Berita',
                'route' => '#',
                'disable' => true,
                'submenu' => [
                    [
                        'label' => 'Kegiatan',
                        'route' => '#',
                        'submenu' => []
                    ],
                    [
                        'label' => 'Artikel / Blog',
                        'route' => '#',
                        'submenu' => []
                    ],
                ]
            ],
            [
                'label' => 'Hubungi Kami',
                'route' => '#',
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

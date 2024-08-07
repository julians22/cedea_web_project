<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\View\Component;

class Nav extends Component
{

    public $nav_items;
    public $locale;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {

        $this->locale = App::currentLocale();

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
                'label' => 'Perusahaan',
                'route' => route('about'),
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
                // 'route' => route('product'),
                'route' => '#',
                'submenu' => [
                    [
                        'label' => 'CEDEA',
                        'route' => '#',
                        'submenu' => []
                    ],
                    [
                        'label' => 'Teman Laut',
                        'route' => '#',
                        'submenu' => []
                    ],
                    [
                        'label' => 'Kreasi Resep',
                        'route' => '#',
                        'submenu' => [
                            [
                                'label' => 'Sarapan',
                                'route' => '#',
                            ],
                            [
                                'label' => 'Makan Siang',
                                'route' => '#',
                            ],
                            [
                                'label' => 'Makan Malam',
                                'route' => '#',
                            ],
                            [
                                'label' => 'Snack',
                                'route' => '#',
                            ],
                        ]
                    ],
                    [
                        'label' => 'Video',
                        'route' => '#',
                        'submenu' => []
                    ],
                    [
                        'label' => 'Belanja',
                        'route' => '#',
                        'submenu' => []
                    ],
                    [
                        'label' => 'Royalti Point',
                        'route' => '#',
                        'submenu' => []
                    ],
                ]
            ],
            [
                'label' => 'Tanggung Jawab Sosial',
                'route' => '#',
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

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Nav extends Component
{

    public $nav_items;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {

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
                        'route' => '#',
                        'submenu' => []
                    ],
                    [
                        'label' => 'Sejarah',
                        'route' => '#',
                        'submenu' => []
                    ],
                    [
                        'label' => 'Visi, Misi & Nilai Perusahaan',
                        'route' => '#',
                        'submenu' => []
                    ],
                    [
                        'label' => 'Wilayah Kerja',
                        'route' => '#',
                        'submenu' => []
                    ],
                ]
            ],
            [
                'label' => 'Merek',
                'route' => route('product'),
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
                        'label' => 'kreasi resep',
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
                'route' => route('about'),
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

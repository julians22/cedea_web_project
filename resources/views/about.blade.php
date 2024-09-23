<x-layouts.app>
    <x-section-banner id="sekilas-perusahaan" :imageUrl="asset('img/sosis-salmon.jpg')" :title="__('about.brief.title')">
        <x-slot:desc>
            <p>
                {{ __('about.brief.detail') }}
            </p>
        </x-slot>
    </x-section-banner>

    {{-- sejarah --}}
    <x-section-banner class="from-cedea-red via-cedea-red" class:title="text-white" class:desc="text-white" id="sejarah"
        :imageUrl="asset('img/cedea-industrial.jpg')" :title="__('about.history.title')">
        <x-slot:desc>
            <p>
                {{ __('about.history.detail') }}
            </p>
        </x-slot>

        <x-slot:button>

            <x-modal.alpine>

                <x-slot:trigger>
                    <button class="w-fit rounded-full bg-white px-4 py-2 text-cedea-red-dark" type="button"
                        @click="modalOpen=true">{{ __('Learn More') }}</button>
                </x-slot:trigger>


                <div class="text-white">
                    <ul class="pr-2">
                        @php
                            $timeline = [
                                [
                                    'date' => '1995',
                                    'title' => 'Berdiri Sejak',
                                    'desc' => 'PT. CitraDimensi Arthali berdiri dengan fokus usaha di industri
                                        perikanan Indonesia. Di awal-awal tahun pendirian perusahaan ini,
                                        ekonomi dalam negeri Indonesia sedang tumbuh pesat menciptakan
                                        peluang usaha yang menjanjikan untuk produk perikanan berkualitas.
                                        Target pasar adalah ritel modern yang juga baru mulai tumbuh saat
                                        itu serta hotel-hotel berbintang.',
                                ],
                                [
                                    'date' => '2004',
                                    'title' => 'Bertumbuh',
                                    'desc' => 'PT. CitraDimensi Arthali mulai melakukan impor produk ikan olahan
                                        berbasis surimi dari Thailand dan Malaysia.',
                                ],
                                [
                                    'date' => '2013',
                                    'title' => 'Memperkuat',
                                    'desc' => 'Perusahaan kembali memperluas area pabrik menjadi 6,000 M2 dan
                                        membangun tambahan gedung produksi baru yang jauh lebih
                                        modern dan canggih. Mesin-mesin otomatis untuk produksi crab stick
                                        dan chikuwa didatangkan dari Jepang. Kapasitas produksi melonjak
                                        dan permintaan pasar atas produk-produk CEDEA terus meningkat.',
                                ],
                                [
                                    'date' => '2013',
                                    'title' => 'Memperluas',
                                    'desc' => 'PT. CitraDimensi Arthali semakin memperluas jaringan pemasaran ke
                                        wilayah baru di Pulau Sumatera. Perusahaan mampu berkembang
                                        lebih dari 30% per tahun dan berhasil memperoleh ISO 22000 dan
                                        penghargaan SNI award kelompok perusahaan menengah besar.',
                                ],
                                [
                                    'date' => '2020',
                                    'title' => 'Automated Production (Industry 4.0)',
                                    'desc' => 'Seiring dengan perkembangan perusahaan dan tuntutan zaman,
                                        CEDEA kembali melakukan penambahan pabrik di Majalengka, Jawa
                                        Barat. Pabrik baru ini dioperasikan dengan mesin otomasi dan
                                        menggunakan teknologi terkini yang sesuai dengan standar industri
                                        4.0.',
                                ],
                                [
                                    'date' => '2022',
                                    'title' => 'Market Leader',
                                    'desc' => 'Perusahaan semakin maju, dan mulai melakukan promosi dan iklan di
                                        TV lokal, theme park, hingga acara - acara musik di Indonesia, hingga
                                        saat ini CEDEA menjadi market leader di antara produsen ikan olahan
                                        beku indonesia.',
                                ],
                                [
                                    'date' => '2024',
                                    'title' => 'Berdiri Pabrik Baru',
                                    'desc' => 'PT. CitraDimensi Arthali kembali memperluas perusahaan dengan
                                        membangun pabrik baru di kota Semarang, Jawa Tengah.',
                                ],
                            ];
                        @endphp

                        @foreach ($timeline as $item)
                            <li class="grid grid-cols-[10%_1fr] ~gap-4/2 [&:last-child>div>div]:before:hidden">
                                <p class="~text-sm/base">{{ $item['date'] }}</p>
                                <div class="relative flex pb-5 pr-2 ~gap-2/6">
                                    <div
                                        class="before:absolute before:left-[5.5px] before:h-full before:w-[1px] before:bg-white">
                                        <svg class="bi bi-circle-fill fill-white" xmlns="http://www.w3.org/2000/svg"
                                            width="12" height="12" viewBox="0 0 16 16">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-androgyne ~text-sm/base">{{ $item['title'] }}</p>
                                        <p class="mt-1 text-justify text-xs">{{ $item['desc'] }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
                </x-modal.alpi>

        </x-slot>
    </x-section-banner>

    {{-- Visi Misi --}}
    <section class="relative ~scroll-mt-12/20" id="visi-misi">
        {{-- gradient bg with container hack --}}
        <div
            class="absolute left-0 top-0 -z-1 grid h-full w-full grid-cols-1 items-start justify-center text-justify text-cedea-red-dark max-md:hidden md:grid-cols-2">
            <div class="visi-misi-gradient h-full w-full">
            </div>
            <div class="visi-misi-gradient h-full w-full">
            </div>
        </div>

        <div
            class="grid grid-cols-1 items-start justify-center text-justify text-cedea-red-dark md:container md:grid-cols-2">
            {{-- visi --}}
            <div
                class="visi-misi-gradient header-padding-safe-area header-padding-safe-area-b flex h-full w-full flex-col justify-start ~p-4/10 md:bg-none">
                <h2 class="mb-4 text-center font-androgyne ~text-2xl/5xl">{{ __('about.Visi.title') }}</h2>
                <p class="text-last-center text-justify">
                    {{ __('about.Visi.detail') }}
                </p>
            </div>
            {{-- misi --}}
            <div
                class="visi-misi-gradient header-padding-safe-area header-padding-safe-area-b flex h-full w-full flex-col justify-start ~p-4/10 md:bg-none">
                <h2 class="mb-4 text-center font-androgyne ~text-2xl/5xl">{{ __('about.Misi.title') }}</h2>
                <p class="text-last-center text-justify">{{ __('about.Misi.detail') }}</p>
            </div>
        </div>
    </section>

    {{-- Value section --}}
    <section class="my-16" id="nilai-nilai-perusahaan">
        <div class="container">
            @php
                $words = [
                    [
                        'text' => 'Giat',
                        'icon' => asset('img/icons/idea.svg'),
                    ],

                    [
                        'text' => 'Iman',
                        'icon' => asset('img/icons/pray.svg'),
                    ],

                    [
                        'text' => 'Gesit',
                        'icon' => asset('img/icons/run.svg'),
                    ],

                    [
                        'text' => 'Inovatif',
                        'icon' => asset('img/icons/bulp.svg'),
                    ],

                    [
                        'text' => 'Handal',
                        'icon' => asset('img/icons/shield.svg'),
                    ],
                ];
            @endphp

            <h2 class="section-title">{{ __('about.value.title') }}</h2>

            <div class="flex items-center justify-center gap-y-6 ~gap-x-2/12">

                @foreach ($words as $index => $word)
                    <div class="gyatt-ribbon relative flex flex-col items-center justify-center text-center shadow-black drop-shadow-2xl"
                        style="z-index: {{ count($words) - $index }}">

                        <div
                            class="-z-1 w-4/5 rounded-t-full border-4 border-white bg-[#b5202b] text-white shadow-black drop-shadow-xl ~p-1/5 ~min-[20rem]/sm:~-mb-2/1 ~min-[20rem]/sm:~h-11/16 sm:w-1/2 sm:~-mb-5/4 sm:~h-14/28 md:border-8">
                            <img class="size-full object-contain object-center" src="{{ $word['icon'] }}"
                                alt="{{ $word['text'] }} icon">
                        </div>

                        <div class="z-1 grid items-center justify-center rounded-md border-4 border-white bg-[linear-gradient(160deg,var(--tw-gradient-stops))] from-[#b5202b] from-0% via-[#b5202b] via-50% to-[#d21b2a] to-50% uppercase text-white ~min-[20rem]/sm:~text-4xl/7xl ~min-[20rem]/sm:~h-14/28 ~min-[20rem]/sm:~w-12/24 sm:rounded-xl sm:border-8 sm:~text-6xl/9xl sm:~h-28/60 sm:~w-24/52"
                            {{-- sm:h-60 sm:w-52 --}}>
                            {{ $word['text'][0] }}
                        </div>
                        <div
                            class="w-4/5 bg-white p-1 text-center font-bold capitalize ~rounded-b-md/xl ~min-[20rem]/sm:~text-xxs/xs sm:w-3/5 sm:~text-sm/2xl">
                            {{ $word['text'] }}
                        </div>
                    </div>
                @endforeach
            </div>

            @php
                $value_list = [
                    [
                        'title' => __('about.value.point1.title'),
                        'content' => __('about.value.point1.detail'),
                    ],
                    [
                        'title' => __('about.value.point2.title'),
                        'content' => __('about.value.point2.detail'),
                    ],
                    [
                        'title' => __('about.value.point3.title'),
                        'content' => __('about.value.point3.detail'),
                    ],
                ];
            @endphp

            <div class="container my-10 flex flex-col gap-y-8">
                @foreach ($value_list as $index => $item)
                    <div class="grid grid-cols-1 gap-x-4 md:grid-cols-[3rem_1fr]">
                        <p
                            class="size-10 rounded-full bg-cedea-red p-2 text-center text-xl font-semibold text-white max-md:hidden">
                            {{ $index + 1 }}
                        </p>

                        <div>
                            <div class="flex-wrap items-center gap-2 gap-y-2 ~mb-2/4 max-md:flex">
                                <p
                                    class="size-10 rounded-full bg-cedea-red p-2 text-center text-xl font-semibold text-white md:hidden">
                                    {{ $index + 1 }}</p>
                                <h3 class="w-fit rounded-full bg-cedea-red px-4 py-2 text-white">
                                    {{ $item['title'] }}
                                </h3>
                            </div>
                            <p class="md:ml-4">{{ $item['content'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- Achieve Section --}}
    <section class="container my-16 grid grid-cols-1 gap-x-8 md:grid-cols-2">
        <div>
            <h2 class="section-title">{{ __('about.mutu.title') }}</h2>
            <p class="~text-xs/base">{{ __('about.mutu.detail') }}</p>
        </div>

        <div class="flex justify-between gap-x-2">
            <div class="~max-w-20/32">
                <img class="invert" src="{{ asset('img/achieve-04.png') }}" alt="">
            </div>

            <div class="~max-w-20/32">
                <img class="" src="{{ asset('img/achieve-03.png') }}" alt="">
            </div>

            <div class="~max-w-20/32">
                <img class="" src="{{ asset('img/achieve-01.png') }}" alt="">
            </div>

            <div class="~max-w-20/32">
                <img class="" src="{{ asset('img/achieve-02.png') }}" alt="">
            </div>
        </div>
    </section>

    {{-- Map --}}
    <section class="group container my-16 pt-2 ~scroll-mt-24/36" id="wilayah">
        <h2 class="section-title transition-all ~pt-0/4">Wilayah Kerja</h2>
        <div class="md:mx-auto md:w-3/4">
            <img src="{{ asset('img/map.svg') }}" alt="">
        </div>

        <div>
            @php
                $addresses = [
                    [
                        'title' => 'PT CitraDimensi Arthali Medan',
                        'content' => 'Jl. KL. Yos Sudarso Km.10,5 Kawasan Industri Medan I (Jl. Pulau Sulawesi)
                        Medan 20242',
                    ],
                    [
                        'title' => 'PT CitraDimensi Arthali Jakarta',
                        'content' => 'Perumahan Prasarana Perikanan Samudera Block N No. 11 - 12,
                        JL Pari Raya, Muara Baru Ujung, Jakarta Utara, DKI Jakarta, 14440',
                    ],
                    [
                        'title' => 'PT CitraDimensi Arthali Majalengka',
                        'content' => 'Jl. Raya Cirebon - Bandung No.Km 35, Sindangwasa, Kec. Palasah,
                        Kabupaten Majalengka, Jawa Barat 45475',
                    ],
                    [
                        'title' => 'PT CitraDimensi Arthali Semarang',
                        'content' =>
                            'Jl. Tambak Aji Raya V No. 9, Tambakaji, Kec. Ngaliyan, Kota Semarang, Jawa Tengah 50185',
                    ],
                ];
            @endphp
            <div class="mt-8 grid gap-8 md:grid-cols-2">
                @foreach ($addresses as $address)
                    <div
                        class="grid grid-cols-[0.4rem_1fr] gap-x-4 rounded-2xl bg-gradient-to-r from-[#EDEDED] to-[#CCCCCC] px-2 py-4">
                        <div class="bg-cedea-red"></div>
                        <div>
                            <h3 class="font-bold">{{ $address['title'] }}</h3>
                            <p>{{ $address['content'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

</x-layouts.app>

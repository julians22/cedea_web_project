<x-layouts.app>

    <section
        class="relative grid max-h-[400px] content-center overflow-hidden lg:max-h-[600px] [&>*]:col-start-1 [&>*]:row-start-1">
        <picture class="overflow-hidden">
            <source class="h-full w-full object-cover" srcset="{{ asset('img/marketplace/header.jpg') }}"
                media="(min-width: 1024px)" />
            <img class="h-full w-full object-cover" src="{{ asset('img/marketplace/header.jpg') }}" alt="">
        </picture>

        <div
            class="container z-1 flex flex-col items-end justify-center gap-4 text-center text-white max-sm:py-4 max-sm:pt-14">
            <div class="flex flex-col items-center justify-center gap-y-6 sm:w-2/5">
                <h1 class="section-title text-inherit drop-shadow-lg">
                    {!! __('marketplace.title') !!}
                </h1>
                <a class="w-fit rounded-full bg-cedea-red px-4 py-2 font-androgyne shadow-lg ~text-sm/xl"
                    href="#marketplace">{!! __('marketplace.cta') !!}</a>
            </div>
        </div>
    </section>

    <section class="container scroll-mt-24" id="marketplace">
        <div class="mx-auto my-12 text-center lg:w-3/4">
            <h2 class="section-title mb-4 text-cedea-red-500">
                {!! __('marketplace.heading') !!}
            </h2>
            <p>
                {{ __('marketplace.desc') }}
            </p>
        </div>
    </section>

    <section class="container grid grid-cols-1 lg:grid-cols-2">
        <div class="self-center max-lg:hidden">
            <img src="{{ asset('img/marketplace/phonev2.png') }}" alt="">
        </div>

        {{-- marketplace --}}
        <div class="my-16 flex flex-col flex-wrap gap-y-4">

            <h2 class="section-title mb-2 text-center">{{ __('marketplace.online') }}</h2>

            <div
                class="grid grid-cols-1 content-center items-center justify-center justify-items-center gap-1 sm:grid-cols-2 md:grid-cols-3 md:justify-center md:justify-items-center">

                @php

                    $marketplace_logos_1 = [
                        [
                            'name' => 'tokopedia',
                            'url' => 'https://www.tokopedia.com/cedeaofficial',
                            'logo' => asset('img/marketplace/tokopedia.png'),
                        ],
                        [
                            'name' => 'shopee',
                            'url' => 'https://shopee.co.id/cedeaofficialjakarta',
                            'logo' => asset('img/marketplace/shopee.png'),
                        ],
                        [
                            'name' => 'blibli',
                            'url' => 'https://www.blibli.com/merchant/cedea-jakarta-pusat-official-store/CEJ-60045',
                            'logo' => asset('img/marketplace/blibli-2.png'),
                        ],
                        [
                            'name' => 'astro',
                            'url' => '#',
                            'logo' => asset('img/marketplace/astro.png'),
                        ],
                        [
                            'name' => 'grab mart',
                            'url' => 'https://r.grab.com/g/2-2-6-C23HL3CEPGKANT',
                            'logo' => asset('img/marketplace/grabmart2.png'),
                        ],
                        [
                            'name' => 'pasar now',
                            'url' => '#',
                            'logo' => asset('img/marketplace/pasarnow.png'),
                        ],
                        [
                            'name' => 'indomaret',
                            'url' => 'https://www.klikindomaret.com/search/?key=Cedea',
                            'logo' => asset('img/marketplace/indomaret.png'),
                        ],
                        [
                            'name' => 'segari',
                            'url' => '#',
                            'logo' => asset('img/marketplace/segari.png'),
                        ],
                        [
                            'name' => 'sayurbox',
                            'url' => 'https://www.sayurbox.com/search?q=cedea',
                            'logo' => asset('img/marketplace/sayurbox.png'),
                        ],
                        [
                            'name' => null,
                            'url' => null,
                            'logo' => null,
                        ],
                        [
                            'name' => 'allofresh',
                            'url' => 'https://www.sayurbox.com/search?q=cedea',
                            'logo' => asset('img/marketplace/allofresh.png'),
                        ],
                    ];
                @endphp

                @foreach ($marketplace_logos_1 as $logo)
                    @if (!$logo['logo'])
                        <div class="flex items-center justify-center ~size-32/36">
                        </div>
                    @else
                        <a class="flex items-center justify-center ~size-32/36" href="{{ $logo['url'] }}">
                            <img class="" src="{{ asset($logo['logo']) }}" alt="logo {{ $logo['name'] }}">
                        </a>
                    @endif
                @endforeach
            </div>

            <div class="mt-8 flex flex-col justify-center gap-6">

                <h2 class="section-title mb-2 text-center">{{ __('marketplace.found') }}</h2>

                @php

                    $marketplace_logos_2 = [
                        [
                            'name' => 'hypermart',
                            'url' => '#',
                            'logo' => asset('img/marketplace/hypermart.png'),
                            'class' => '',
                        ],
                        [
                            'name' => 'yogya group',
                            'url' => '#',
                            'logo' => asset('img/marketplace/yogyagroup.png'),
                            'class' => '',
                        ],
                        [
                            'name' => 'indomaret fresh',
                            'url' => '#',
                            'logo' => asset('img/marketplace/indomaret-fresh.png'),
                            'class' => 'p-4',
                        ],
                        [
                            'name' => 'alfamidi',
                            'url' => '#',
                            'logo' => asset('img/marketplace/alfamidi.png'),
                            'class' => 'p-4',
                        ],
                        [
                            'name' => 'foodhall',
                            'url' => '#',
                            'logo' => asset('img/marketplace/foodhall.png'),
                            'class' => 'p-4',
                        ],
                        [
                            'name' => 'farmermarket',
                            'url' => '#',
                            'logo' => asset('img/marketplace/farmermarket.png'),
                            'class' => '',
                        ],
                        [
                            'name' => 'lottemart',
                            'url' => '#',
                            'logo' => asset('img/marketplace/lottemart.png'),
                            'class' => 'p-4',
                        ],
                        [
                            'name' => 'ranchmarket',
                            'url' => '#',
                            'logo' => asset('img/marketplace/ranchmarket.png'),
                            'class' => '',
                        ],
                        [
                            'name' => 'aeon',
                            'url' => '#',
                            'logo' => asset('img/marketplace/aeon.png'),
                            'class' => 'p-4',
                        ],
                        [
                            'name' => 'superindo',
                            'url' => '#',
                            'logo' => asset('img/marketplace/superindo.png'),
                            'class' => 'p-4',
                        ],
                    ];
                @endphp

                <div class="flex flex-wrap items-center justify-center gap-6">
                    @foreach (array_slice($marketplace_logos_2, 0, 2) as $logo)
                        <a class="inline-grid h-20 max-w-40 flex-initial content-center justify-center text-center"
                            href="{{ $logo['url'] }}">
                            <img src="{{ asset($logo['logo']) }}" alt="logo {{ $logo['name'] }}">
                        </a>
                    @endforeach
                </div>

                <div class="flex flex-wrap items-center justify-center gap-6">
                    @foreach (array_slice($marketplace_logos_2, 2) as $logo)
                        <a class="{{ TailwindMerge\Laravel\Facades\TailwindMerge::merge('inline-grid h-20 max-w-40 flex-initial content-center justify-center text-center', $logo['class']) }}"
                            href="{{ $logo['url'] }}">
                            <img src="{{ asset($logo['logo']) }}" alt="logo {{ $logo['name'] }}">
                        </a>
                    @endforeach
                </div>

            </div>

        </div>

    </section>


    <section class="relative min-h-96 overflow-clip bg-cedea-red bg-shippo bg-blend-multiply">
        <span
            class="container absolute bottom-0 right-1/2 min-h-48 translate-x-1/2 bg-opacity-5 bg-asia-pattern bg-contain bg-center bg-no-repeat ~h-[15rem]/[30rem] max-md:top-32 md:bg-[right_2rem_bottom_1%]">
        </span>

        <div class="isolate bg-marketplace-footer bg-contain bg-bottom bg-no-repeat">
            <div class="container relative isolate grid grid-cols-1 py-8 ~gap-2/12 md:grid-cols-[1fr_40%]">
                {{-- shops photos --}}
                <div class="text-center max-md:order-2 md:ml-12">
                    <h2 class="section-title text-center font-normal text-white ~mb-2/4">
                        {!! __('marketplace.footer') !!}
                    </h2>
                    <div class="grid grid-cols-2 gap-2 ~py-2/8 md:grid-cols-4">
                        @for ($i = 1; $i < 21; $i++)
                            <div class="rounded-xl border-4 border-white">
                                <img src="{{ asset('img/marketplace/places/place-' . $i . '.png') }}" alt="">
                            </div>
                        @endfor
                    </div>
                </div>
                {{-- shops photos end --}}
                <div class="flex flex-col justify-between ~gap-2/4 max-md:mb-8">
                    <div class="-mt-8 flex w-full justify-center">
                        <x-logo class="block max-w-44 text-blue-400 shadow-nav" />
                    </div>
                    <div class="section-title mb-4 text-center font-normal text-white ~text-3xl/7xl">
                        {{-- <h2 class="font-cedea mt-4">진짜 맛있다</h2> --}}
                        <h2 class="whitespace-nowrap font-lobster ~text-5xl/8xl">{!! __('marketplace.daebak') !!}</h2>
                    </div>
                    <div>
                        <img src="{{ asset('img/marketplace/packages.png') }}" alt="packages">
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>

<x-layouts.app>
    <div class="bg-brick">

        <section
            class="relative grid max-h-[400px] content-center overflow-hidden lg:max-h-[600px] [&>*]:col-start-1 [&>*]:row-start-1">
            <picture class="overflow-hidden">
                <source class="h-full w-full object-cover" srcset="{{ asset('placeholder/banner/marketplace.jpg') }}"
                    media="(min-width: 1024px)" />
                <img class="h-full w-full object-cover" src="{{ asset('placeholder/banner/marketplace.jpg') }}"
                    alt="">
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
            <div class="my-16 flex flex-col flex-wrap gap-y-4 [&_img]:max-h-28">

                <h2 class="section-title mb-2 text-center">{{ __('marketplace.online') }}</h2>

                <div class="grid grid-cols-2 items-center justify-center justify-items-center gap-4 md:grid-cols-3">

                    @php
                        $marketplace_logos_1 = [
                            'tokopedia' => 'img/marketplace/tokopedia.png',
                            'shopee' => 'img/marketplace/shopee.png',
                            'blibli' => 'img/marketplace/blibli-2.png',
                            'astro' => 'img/marketplace/astro.png',
                            'grab mart' => 'img/marketplace/grabmart2.png',
                            'pasar now' => 'img/marketplace/pasarnow.png',
                            'indomaret' => 'img/marketplace/indomaret.png',
                            'segari' => 'img/marketplace/segari.png',
                            'sayurbox' => 'img/marketplace/sayurbox.png',
                        ];
                    @endphp

                    @foreach ($marketplace_logos_1 as $name => $path)
                        <div class="p-6">
                            <img src="{{ asset($path) }}" alt="logo {{ $name }}">
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 flex flex-col justify-center gap-12">

                    <h2 class="section-title mb-2 text-center">{{ __('marketplace.found') }}</h2>

                    @php
                        $marketplace_logos_2 = [
                            'hypermart' => 'img/marketplace/hypermart.png',
                            'yogya group' => 'img/marketplace/yogyagroup.png',
                            'indomaret fresh' => 'img/marketplace/indomaret-fresh.png',
                            'alfamidi' => 'img/marketplace/alfamidi.png',
                            'foodhall' => 'img/marketplace/foodhall.png',
                            'farmermarket' => 'img/marketplace/farmermarket.png',
                            'lottemart' => 'img/marketplace/lottemart.png',
                            'ranchmarket' => 'img/marketplace/ranchmarket.png',
                            'aeon' => 'img/marketplace/aeon.png',
                            'superindo' => 'img/marketplace/superindo.png',
                        ];
                    @endphp

                    <div class="flex flex-wrap items-center justify-center gap-12">
                        @foreach (array_slice($marketplace_logos_2, 0, 2) as $name => $path)
                            <div class="max-w-40 flex-initial text-center">
                                <img src="{{ asset($path) }}" alt="logo {{ $name }}">
                            </div>
                        @endforeach
                    </div>

                    <div class="flex flex-wrap items-center justify-center gap-12">
                        @foreach (array_slice($marketplace_logos_2, 2) as $name => $path)
                            <div class="max-w-40 flex-initial text-center">
                                <img src="{{ asset($path) }}" alt="logo {{ $name }}">
                            </div>
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
                                    <img src="{{ asset('img/marketplace/places/place-' . $i . '.png') }}"
                                        alt="">
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
                            <h2 class="font-cedea mt-4">진짜 맛있다</h2>
                            <h3 class="whitespace-nowrap">Jinjja Masisseoyo</h3>
                        </div>
                        <div>
                            <img src="{{ asset('img/marketplace/packages.png') }}" alt="packages">
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>
</x-layouts.app>

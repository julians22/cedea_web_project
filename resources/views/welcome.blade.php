<x-layouts.app>

    {{-- Banner Section --}}
    <x-header-banner :banners="$banners" />

    <x-section-banner :imageUrl="asset('img/sosis-salmon.jpg')" :imageLeft="false" :title="__('home.closer.title')">
        <x-slot:desc>
            <p>{{ __('home.closer.detail') }}</p>
        </x-slot:desc>

        <x-slot:button>
            <a class="w-fit rounded-full bg-cedea-red-dark px-4 py-2 text-white" href="{{ route('about') }}">
                {{ __('Read More') }}
            </a>
        </x-slot:button>
    </x-section-banner>

    <x-section-banner :gradient=false :imageUrl="asset('img/mutu.jpg')" :title="__('home.quality.title')">

        <x-slot:desc>
            <p>
                {{ __('home.quality.detail') }}
            </p>
        </x-slot:desc>


        <x-slot:button>
            <a class="w-fit rounded-full bg-cedea-red-dark px-4 py-2 text-white" href="{{ route('product') }}">
                {{ __('See Product') }}
            </a>
        </x-slot:button>
    </x-section-banner>

    {{-- News Section --}}
    {{-- <livewire:news-section /> --}}

    {{-- marketplace Section --}}
    <div class="container my-12 flex justify-center gap-2 px-4 lg:px-0">

        <div class="shrink basis-96 max-md:hidden">
            <img class="w-full" src="{{ asset('img/marketplace-phone_2.png') }}" alt="">
        </div>

        <div class="col-span-5 lg:col-span-3">
            <div class="flex h-full flex-col justify-center">
                <h2 class="section-title text-center leading-[1.2]">
                    {!! __('home.marketplace.title') !!}
                </h2>

                <div class="mt-4 flex items-center justify-center gap-4 max-sm:flex-wrap lg:mt-8">
                    <div class="shrink basis-44 md:hidden">
                        <img class="w-full" src="{{ asset('img/marketplace-phone.png') }}" alt="">
                    </div>
                    <div class="flex flex-wrap items-end justify-center ~gap-2/8">
                        @php
                            $marketplaces = [
                                [
                                    'name' => 'shopee',
                                    'url' => 'https://shopee.co.id/cedeaofficialjakarta',
                                    'logo' => asset('img/marketplace/shopee.png'),
                                ],
                                [
                                    'name' => 'tokopedia',
                                    'url' => 'https://www.tokopedia.com/cedeaofficial',
                                    'logo' => asset('img/marketplace/tokopedia.png'),
                                ],
                                [
                                    'name' => 'grabmart',
                                    'url' => 'https://r.grab.com/g/2-2-6-C23HL3CEPGKANT',
                                    'logo' => asset('img/marketplace/grabmart.png'),
                                ],
                                [
                                    'name' => 'blibli',
                                    'url' =>
                                        'https://www.blibli.com/merchant/cedea-jakarta-pusat-official-store/CEJ-60045?utm_campaign=merchant%20share&utm_medium=share&utm_source=web&pickupPointCode=PP-3272245&fbbActivated=false',
                                    'logo' => asset('img/marketplace/blibli.png'),
                                ],
                                [
                                    'name' => 'indomaret',
                                    'url' => 'https://www.klikindomaret.com/search/?key=Cedea',
                                    'logo' => asset('img/marketplace/indomaret.png'),
                                ],
                                [
                                    'name' => 'sayurbox',
                                    'url' => 'https://www.sayurbox.com/search?q=cedea',
                                    'logo' => asset('img/marketplace/sayurbox.png'),
                                ],
                            ];
                        @endphp

                        @foreach ($marketplaces as $marketplace)
                            <a class="flex items-center justify-center rounded-xl bg-white text-center shadow-top-hover transition duration-700 ease-in-out ~size-16/28 ~p-2/4 hover:scale-110 hover:shadow-lg md:shadow-top md:hover:shadow-top-hover"
                                href="{{ $marketplace['url'] }}" target="_blank">
                                <img src="{{ $marketplace['logo'] }}" alt="{{ $marketplace['name'] }} logo">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>

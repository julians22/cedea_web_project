<x-layouts.app>


    {{-- Banner Section --}}
    <section>
        <x-home.banner />
    </section>

    <x-section-banner :imageUrl="asset('img/sosis-salmon.jpg')" title="Kenal Lebih Dekat">

        <x-slot:desc>
            <p>
                PT CitraDimensi Arthali merupakan salah satu perusahaan di Indonesia yang bergerak di bidang pengolahan
                hasil perikanan dan manufaktur frozen seafood dengan brand CEDEA yang berlokasi di Muara Baru, Jakarta
                Utara. Berdiri sejak 1995, PT CitraDimensi Arthali juga merupakan pelopor industri makanan olahan
                berbasis
                hasil laut.
            </p>
        </x-slot>

        <x-slot:button>
            <a class="w-fit rounded-full bg-cedea-red px-4 py-2 text-white" href="{{ route('about') }}">
                Baca Selengkapnya
            </a>
        </x-slot>
    </x-section-banner>

    <x-section-banner :gradient=false :imageUrl="asset('img/mutu.jpg')" title="Mutu yang Tetap Terjaga">

        <x-slot:desc>
            <p>
                CEDEA SEAFOOD diproduksi oleh PT CitraDimensi Arthali
                yang berkomitmen untuk terus menghasilkan makanan
                beku dari ikan olahan terbaik dengan penerapan GMP,
                HACCP, ISO 22000, BPOM, Halal.
            </p>
        </x-slot>


        <x-slot:button>
            <button class="w-fit rounded-full bg-cedea-red px-4 py-2 text-white">
                Lihat Produk
            </button>
        </x-slot>
    </x-section-banner>

    {{-- News Section --}}
    <livewire:news-section />


    {{-- Marketplace Section --}}
    <div class="container my-12 flex justify-center gap-2 px-4 lg:px-0">

        <div class="shrink basis-96 max-md:hidden">
            <img class="w-full" src="{{ asset('img/marketplace-phone_2.png') }}" alt="">
        </div>

        <div class="col-span-5 lg:col-span-3">
            <div class="flex h-full flex-col justify-center">
                <h2 class="section-title">
                    Nggak Ada
                    Waktu Belanja? Pesan Online Solusinya!
                </h2>

                <div class="mt-4 flex flex-wrap items-end justify-center ~gap-2/8 lg:mt-8">
                    @php
                        $marketplaces = [
                            [
                                'name' => 'shopee',
                                'url' => 'https://shopee.co.id/cedeaofficialjakarta',
                                'logo' => asset('img/Marketplace/shopee.png'),
                            ],
                            [
                                'name' => 'tokopedia',
                                'url' => 'https://www.tokopedia.com/cedeaofficial',
                                'logo' => asset('img/Marketplace/tokopedia.png'),
                            ],
                            [
                                'name' => 'grabmart',
                                'url' => 'https://mart.grab.com/id/id/search?keyword=Cedea',
                                'logo' => asset('img/Marketplace/grabmart.png'),
                            ],
                            [
                                'name' => 'blibli',
                                'url' =>
                                    'https://www.blibli.com/merchant/cedea-jakarta-pusat-official-store/CEJ-60045?utm_campaign=merchant%20share&utm_medium=share&utm_source=web&pickupPointCode=PP-3272245&fbbActivated=false',
                                'logo' => asset('img/Marketplace/blibli.png'),
                            ],
                            [
                                'name' => 'indomaret',
                                'url' => 'https://www.klikindomaret.com/search/?key=Cedea',
                                'logo' => asset('img/Marketplace/indomaret.png'),
                            ],
                            [
                                'name' => 'sayurbox',
                                'url' => 'https://www.sayurbox.com/search?q=cedea',
                                'logo' => asset('img/Marketplace/sayurbox.png'),
                            ],
                        ];
                    @endphp

                    @foreach ($marketplaces as $marketplace)
                        <a class="~size-16/28 flex items-center justify-center rounded-xl bg-white p-4 text-center shadow-top-hover transition duration-700 ease-in-out hover:scale-110 hover:shadow-lg md:shadow-top md:hover:shadow-top-hover"
                            href="{{ $marketplace['url'] }}" target="_blank">
                            <img src="{{ $marketplace['logo'] }}" alt="{{ $marketplace['name'] }} logo">
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

</x-layouts.app>

<x-layouts.app>
    {{-- Banner Section --}}
    <section>
        <x-home.banner />
    </section>

    <x-section-banner :imageUrl="asset('img/sosis-salmon.jpg')" title="Kenal Lebih Deka">

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
            <button class="rounded-full bg-cedea-red px-4 py-2 text-white">
                Baca Selengkapnya
            </button>
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
            <button class="rounded-full bg-cedea-red px-4 py-2 text-white">
                Lihat Product
            </button>
        </x-slot>
    </x-section-banner>

    {{-- News Section --}}
    <section class="relative bg-cedea-red bg-left-top bg-repeat py-8 bg-blend-multiply xl:py-10"
        style="background-size: 10%; background-image: url({{ asset('img/home-pattern.png') }})">

        <div class="container">
            <h2 class="font-great-vibes text-white ~text-2xl/4xl">
                Artikel Terkini
            </h2>

            <div class="mb-8 mt-2 flex justify-between text-white">
                <div class="flex gap-x-8">
                    <p class="flex flex-col after:h-0.5 after:w-1/2 after:bg-white">Berita</p>
                    <p class="">Kreasi terkini</p>
                </div>
                <a class="rounded-full bg-white px-2 py-1 text-cedea-red">
                    Semua Berita
                </a>
            </div>

            <div class="grid grid-flow-dense grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">

                {{-- featured news --}}
                <div
                    class="col-span-1 row-span-1 overflow-hidden rounded-xl md:col-span-2 md:row-span-1 lg:row-span-3 2xl:[&:not(:only-child)]:mr-8">
                    <img src="{{ asset('img/mutu.jpg') }}" alt="">
                    <div class="flex flex-col gap-y-4 bg-white p-4">
                        <p>08 Mei 2024 | Berita</p>
                        <h2 class="~text-lg/xl">CEDEA Goes to School Edukasi Makan Ikan Jadi Anak Pintar</h2>
                        <button class="rounded-xl bg-cedea-yellow-1 px-8 py-1 uppercase text-cedea-red">
                            Baca Beritanya
                        </button>
                    </div>
                </div>

                {{-- news list --}}
                {{-- <div class="grid grid-cols-2 gap-4"> --}}
                @for ($i = 0; $i < 6; $i++)
                    <div class="flex overflow-hidden rounded-xl">
                        <img class="h-full w-40 object-cover" src="{{ asset('img/mutu.jpg') }}" alt="">
                        <div class="flex-col gap-y-8 space-y-4 bg-white p-4">
                            <p>{{ $i }} Mei 2024 | Berita</p>
                            <h2 class="~text-xs/base">CEDEA Goes to School Edukasi Makan Ikan Jadi Anak Pintar</h2>
                        </div>
                    </div>
                @endfor
                {{-- </div> --}}
            </div>
        </div>
    </section>

    {{-- Marketplace Section --}}
    <div class="container my-12 flex justify-center gap-8 px-4 lg:px-0">

        <div class="basis-80">
            <img class="w-full" src="{{ asset('img/marketplace-obj.png') }}" alt="">
        </div>

        <div class="col-span-5 lg:col-span-3">
            <div class="flex h-full flex-col justify-center">
                <h2 class="text-center font-great-vibes text-cedea-red ~text-2xl/6xl">
                    Nggak Ada
                    Waktu Belanja? Pesan Online Solusinya!
                </h2>

                <div class="mt-4 flex flex-wrap items-end justify-center ~gap-x-2/8 lg:mt-8">
                    <div class="~size-20/32 flex items-center justify-center rounded-xl p-4 text-center shadow-lg">
                        <img src="{{ asset('img/Marketplace/shopee.png') }}" alt="">
                    </div>

                    <div class="~size-20/32 flex items-center justify-center rounded-xl p-4 text-center shadow-lg">
                        <img src="{{ asset('img/Marketplace/tokopedia.png') }}" alt="">
                    </div>

                    <div class="~size-20/32 flex items-center justify-center rounded-xl p-4 text-center shadow-lg">
                        <img src="{{ asset('img/Marketplace/grabmart.png') }}" alt="">
                    </div>

                    <div class="~size-20/32 flex items-center justify-center rounded-xl p-4 text-center shadow-lg">
                        <img src="{{ asset('img/Marketplace/blibli.png') }}" alt="">
                    </div>

                    <div class="~size-20/32 flex items-center justify-center rounded-xl p-4 text-center shadow-lg">
                        <img src="{{ asset('img/Marketplace/indomaret.png') }}" alt="">
                    </div>

                    <div class="~size-20/32 flex items-center justify-center rounded-xl p-4 text-center shadow-lg">
                        <img src="{{ asset('img/Marketplace/sayurbox.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>

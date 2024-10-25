<x-layouts.app>
    <div class="bg-brick">

        <section
            class="relative grid max-h-[400px] content-center overflow-hidden md:max-h-[600px] [&>*]:col-start-1 [&>*]:row-start-1">
            <picture class="overflow-hidden">
                <source class="h-full w-full" srcset="{{ asset('placeholder/banner/marketplace.jpg') }}"
                    media="(min-width: 1024px)" />
                <img src="{{ asset('placeholder/banner/marketplace.jpg') }}" alt="">
            </picture>

            <div
                class="container z-1 flex flex-col items-end justify-center gap-4 text-center text-white max-sm:py-4 max-sm:pt-14">
                <div class="flex flex-col items-center justify-center gap-y-6 sm:w-2/5">
                    <h1 class="section-title text-inherit">
                        Rasakan Kelezatan <span class="~text-2xl/6xl"><span class="font-cedea">CEDEA</span>
                            Seafood</span>
                        dari <span class="~text-2xl/6xl">Rumah!</span>
                    </h1>
                    <a class="w-fit rounded-full bg-cedea-red px-4 py-2 font-androgyne shadow-lg ~text-sm/xl"
                        href="#">Pesan CEDEA Seafood Sekarang!</a>
                </div>
            </div>
        </section>

        <section class="container">
            <div class="mx-auto my-12 text-center md:w-3/4">
                <h2 class="section-title mb-4 text-cedea-red-500">
                    Nikmati Kelezatan Laut Langsung dari Rumah dengan <span class="font-cedea">CEDEA</span> Seafood!
                </h2>
                <p>
                    Ingin menikmati hidangan Ikan Olahan Bermutu tanpa harus meninggalkan kenyamanan rumah? Cedea
                    Seafood
                    hadir
                    untuk memenuhi keinginan Anda dengan cara yang mudah dan praktis! Kini, Anda bisa membeli produk
                    Ikan
                    Olahan
                    dengan kualitas premium, langsung melalui e-commerce favorit Anda, tanpa perlu repot pergi ke toko.
                </p>
            </div>
        </section>

        <section class="container flex">
            <div class="shrink grow-0 basis-1/2 max-md:hidden">
                <img src="{{ asset('img/Marketplace/phone.png') }}" alt="">
            </div>

            {{-- marketplace --}}
            <div class="my-16 flex flex-col flex-wrap gap-y-4 [&_img]:max-h-28">

                <div class="flex flex-wrap justify-center gap-12">
                    <a href="#">
                        <img src="{{ asset('img/Marketplace/tokopedia.png') }}" alt="logo tokopedia">
                    </a>
                    <a href="#">
                        <img src="{{ asset('img/Marketplace/shopee.png') }}" alt="logo shopee">
                    </a>
                    <a href="#">
                        <img src="{{ asset('img/Marketplace/blibli-2.png') }}" alt="logo blibli">
                    </a>
                </div>

                <div
                    class="text-nowrap flex items-center justify-center gap-x-4 text-lg before:h-1 before:w-1/3 before:bg-cedea-red-500 after:h-1 after:w-1/3 after:bg-cedea-red-500">
                    di Official Store:
                </div>

                <div class="flex flex-col justify-center gap-12">
                    <div class="flex justify-center gap-12 max-md:flex-wrap">
                        <a href="#">
                            <img src="{{ asset('img/Marketplace/hypermart.png') }}" alt="logo hypermart">
                        </a>

                        <a href="#">
                            <img src="{{ asset('img/Marketplace/superindo.png') }}" alt="logo superindo">
                        </a>

                        <a href="#">
                            <img src="{{ asset('img/Marketplace/yogyagroup.png') }}" alt="logo yogya group">
                        </a>
                    </div>

                    <div class="flex justify-center gap-12 max-md:flex-wrap">
                        <a href="#">
                            <img src="{{ asset('img/Marketplace/indomaret-2.png') }}" alt="logo indomaret">
                        </a>

                        <a href="#">
                            <img src="{{ asset('img/Marketplace/alfamart.png') }}" alt="logo alfamart">
                        </a>
                    </div>
                </div>

            </div>

        </section>

        <section class="container my-36">
            <h2 class="section-title text-center">Belanja online</h2>
            <div class="flex flex-wrap items-center justify-center gap-12">
                <a href="#">
                    <img src="{{ asset('img/Marketplace/astro.png') }}" alt="">
                </a>
                <a href="#">
                    <img src="{{ asset('img/Marketplace/grabmart2.png') }}" alt="">
                </a>
                <a href="#">
                    <img src="{{ asset('img/Marketplace/pasarnow.png') }}" alt="">
                </a>
                <a href="#">
                    <img src="{{ asset('img/Marketplace/indomaret.png') }}" alt="">
                </a>
                <a href="#">
                    <img src="{{ asset('img/Marketplace/sayurbox.png') }}" alt="">
                </a>
            </div>
        </section>

        <section class="container my-16">
            <h2 class="section-title text-center">Belanja Offline - Tersedia di 50 Toko ini:</h2>
            @php
                $stores = [
                    'AEON',
                    'Alfamart',
                    'Alfamidi',
                    'Allo Fresh',
                    'Aneka Buana',
                    'Astro',
                    'Borma',
                    'Budiman Swalayan',
                    'Cicle K',
                    'Diamond',
                    'Diskon Supermarket',
                    'Duta Buah',
                    'Farmers Market',

                    'Fortuna swalayan',
                    'Food Hall',
                    'Galael',
                    'Grab Mart Kilat',
                    'Gourmet',
                    'Grand Lucky',
                    'Hadi Supermarket',
                    'Hari-Hari',
                    'Hero',
                    'Hapimart',
                    'Indogrosir',
                    'Indomaret Fresh',
                    'Jakarta Fruit',

                    'K-Stop',
                    'KEbun Buah',
                    'LSI',
                    'Lawson',
                    'Lulu',
                    'Lotte Grosir',
                    'LotteMart',
                    'Market City',
                    'M Blok',
                    'Mugunghwa',
                    'Naga Swalayan',
                    'Narma',
                    'Papaya',

                    'Pasarnow',
                    'Ramayana',
                    'Ranch Market',
                    'Rumah Buah',
                    'Saga',
                    'Segarai',
                    'sayurbox',
                    'Tiptop',
                    'Toserba Berkah',
                    'Toserba Gading',
                    'Transmart',
                ];
            @endphp
            <div
                class="flow grid grid-cols-2 items-center justify-center gap-y-2 sm:grid-cols-3 md:~gap-x-28/40 lg:grid-flow-col lg:grid-rows-[repeat(13,minmax(0,1fr))]">
                @foreach ($stores as $store)
                    <a href="#">{{ $store }}</a>
                @endforeach
            </div>
        </section>
    </div>

</x-layouts.app>

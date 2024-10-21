<x-layouts.app>

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
                <h1 class="section-title">
                    Rasakan Kelezatan <span class="~text-2xl/6xl"><span class="font-cedea">CEDEA</span> Seafood</span>
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
                Ingin menikmati hidangan Ikan Olahan Bermutu tanpa harus meninggalkan kenyamanan rumah? Cedea Seafood
                hadir
                untuk memenuhi keinginan Anda dengan cara yang mudah dan praktis! Kini, Anda bisa membeli produk Ikan
                Olahan
                dengan kualitas premium, langsung melalui e-commerce favorit Anda, tanpa perlu repot pergi ke toko.
            </p>
        </div>
    </section>

    <section class="container grid grid-cols-2">
        <div><img src="{{ asset('img/marketplace/phone.png') }}" alt=""></div>
        <div>
            <a href=""><img src="{{ asset('marketpal') }}" alt=""></a>
            <a href=""><img src="{{ asset('marketpal') }}" alt=""></a>
            <a href=""><img src="{{ asset('marketpal') }}" alt=""></a>
        </div>
    </section>

</x-layouts.app>

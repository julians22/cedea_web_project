

@extends('layouts.app')

@section('content')
{{-- Banner Section --}}
<section>
    <!-- Slider main container -->
    <div class="swiper home-swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <img src="{{ asset('img/banner-2.jpg') }}" class="w-full hidden sm:block">
                <img src="{{ asset('img/banner-mobile-2.jpg') }}" class="w-full block sm:hidden">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('img/banner-2.jpg') }}" class="w-full hidden sm:block">
                <img src="{{ asset('img/banner-mobile-2.jpg') }}" class="w-full block sm:hidden">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('img/banner-2.jpg') }}" class="w-full hidden sm:block">
                <img src="{{ asset('img/banner-mobile-2.jpg') }}" class="w-full block sm:hidden">
            </div>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>
</section>

<section class="relative overflow-hidden">
    {{-- About Section --}}
    <div class="py-8 xl:py-10 relative z-10">
        <div class="container space-y-8 flex flex-col">
            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-6 items-center px-4 lg:px-0">
                {{-- <div class="col-span-2 hidden lg:block">
                    <img src="{{ asset('img/ikan/left-1.png') }}" alt="">
                    <img src="{{ asset('img/ikan/left-2.png') }}" alt="">
                    <img src="{{ asset('img/ikan/left-3.png') }}" alt="">
                </div> --}}
                <div class="col-span-12 lg:col-start-3 lg:col-span-8 flex flex-col space-y-4 lg:space-y-8 ">
                    <div class="text-center text-cedea-red cedea-title">Kenali Lebih Dekat</div>
                    <div class="max-w-4xl mx-auto relative flex flex-col md:flex-row space-x-0 lg:space-x-8 w-full items-center space-y-4 lg:space-y-0">
                        <div class="w-2/5 hidden lg:block">
                            <img src="{{ asset('img/logo-cedea.png') }}" alt="" class="w-full">
                        </div>
                        <div class="w-full lg:w-3/5">
                            <p class="text-center lg:text-left">PT CitraDimensi Arthali merupakan salah satu perusahaan di Indonesia yang bergerak di bidang pengolahan hasil perikanan dan manufaktur frozen seafood dengan brand CEDEA yang berlokasi di Muara Baru, Jakarta Utara. Berdiri sejak 1995, PT CitraDimensi Arthali juga merupakan pelopor industri makanan olahan berbasis hasil laut. </p>
                        </div>

                    </div>
                    <a href="{{ route('about') }}" class="rounded-full px-4 py-2 bg-cedea-red text-white font-medium lg:font-semibold text-base lg:text-xl inline-flex self-center">
                        Baca Selengkapnya
                    </a>
                </div>
                {{-- <div class="col-span-2 hidden lg:block">
                    <img src="{{ asset('img/ikan/right-1.png') }}" alt="">
                    <img src="{{ asset('img/ikan/right-2.png') }}" alt="">
                    <img src="{{ asset('img/ikan/right-3.png') }}" alt="">
                    <img src="{{ asset('img/ikan/right-3.png') }}" alt="">
                </div> --}}

            </div>
        </div>

    </div>

    {{-- left-wave --}}
    <div class="overflow-hidden">
        <div
            data-aos="fade-right"
            data-aos-once="false"
            data-aos-offset="500"
            data-aos-duration="700"
            style="background-image: url('{{asset('img/wave/wave-1-left.png')}}');"
            class="wave-img wave-left-layout wave-1"></div>
        <div
            data-aos="fade-right"
            data-aos-once="false"
            data-aos-offset="500"
            data-aos-duration="700"
            style="background-image: url('{{asset('img/wave/wave-2-left.png')}}');"
            class="wave-img wave-left-layout wave-2"></div>
        <div
            data-aos="fade-right"
            data-aos-once="false"
            data-aos-offset="500"
            data-aos-duration="700"
            style="background-image: url('{{asset('img/wave/wave-3-left.png')}}');"
            class="wave-img wave-left-layout wave-3"></div>
        <div
            data-aos="fade-right"
            data-aos-once="false"
            data-aos-offset="500"
            data-aos-duration="700"
            style="background-image: url('{{asset('img/wave/wave-4-left.png')}}');"
            class="wave-img wave-left-layout wave-4"></div>
        <div
            data-aos="fade-right"
            data-aos-once="false"
            data-aos-offset="500"
            data-aos-duration="700"
            style="background-image: url('{{asset('img/wave/wave-5-left.png')}}');"
            class="wave-img wave-left-layout wave-5"></div>
        <div
            data-aos="fade-right"
            data-aos-once="false"
            data-aos-offset="500"
            data-aos-duration="700"
            style="background-image: url('{{asset('img/wave/wave-6-left.png')}}');"
            class="wave-img wave-left-layout wave-6"></div>
    </div>

    {{-- right-wave --}}
    <div class="overflow-hidden">
        <div
            data-aos="fade-left"
            data-aos-once="false"
            data-aos-offset="500"
            data-aos-duration="800"
            style="background-image: url('{{asset('img/wave/wave-1-right.png')}}');"
            class="wave-img wave-right-layout wave-1"></div>
        <div
            data-aos="fade-left"
            data-aos-once="false"
            data-aos-offset="500"
            data-aos-duration="800"
            style="background-image: url('{{asset('img/wave/wave-2-right.png')}}');"
            class="wave-img wave-right-layout wave-2"></div>
        <div
            data-aos="fade-left"
            data-aos-once="false"
            data-aos-offset="500"
            data-aos-duration="800"
            style="background-image: url('{{asset('img/wave/wave-3-right.png')}}');"
            class="wave-img wave-right-layout wave-3"></div>
        <div
            data-aos="fade-left"
            data-aos-once="false"
            data-aos-offset="500"
            data-aos-duration="800"
            style="background-image: url('{{asset('img/wave/wave-4-right.png')}}');"
            class="wave-img wave-right-layout wave-4"></div>
        <div
            data-aos="fade-left"
            data-aos-once="false"
            data-aos-offset="500"
            data-aos-duration="800"
            style="background-image: url('{{asset('img/wave/wave-5-right.png')}}');"
            class="wave-img wave-right-layout wave-5"></div>
    </div>

    {{-- Produk Section --}}
    <div class="pb-8 lg:pb-0 pt-4 md:pt-8 xl:pt-10 relative z-10">
        <div class="container space-y-4 lg:space-y-8 flex flex-col">
            <div class="text-center text-cedea-red cedea-title">Produk</div>
            <h4 class="text-center text-cedea-red font-bold lg:font-normal">Jelajahi kekayaan laut dengan rangkaian produk terbaik dari Cedea Seafood!</h4>
            <div class="max-w-full lg:max-w-4xl mx-auto relative flex w-full items-center justify-center space-x-0 lg:space-x-8 px-4 lg:px-0">
                @foreach ($categories as $item)
                    <div class="w-1/2 lg:w-2/6">
                        <img src="{{ $item->media[0]->original_url }}" alt="" class="w-full">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="text-center relative container pt-8 hidden lg:block">
            <img src="{{ asset('img/product-line.png') }}" alt="" class="w-full translate-y-4 transform">
        </div>
    </div>
</section>

{{-- Achieve Section --}}
<section class="bg-cedea-red py-8 xl:py-10 relative bg-blend-multiply bg-left-top bg-repeat" style="background-size: 150px; background-image: url({{asset('img/home-pattern.png')}})">
    {{-- <div class="absolute inset-0 z-10" ></div> --}}
    <div class="container space-y-8 z-20 relative px-4 lg:px-0">
        <div class="text-white cedea-title text-center">Mutu yang Tetap Terjaga</div>
        <div class="flex space-x-0 lg:space-x-10 justify-around lg:justify-center flex-wrap">
            <div class="w-full max-w-24 lg:max-w-48">
                <img src="{{ asset('img/achieve-04.png') }}" class="w-full" alt="">
            </div>
            <div class="w-full max-w-24 lg:max-w-48">
                <img src="{{ asset('img/achieve-03.png') }}" class="w-full" alt="">
            </div>
            <div class="w-full max-w-24 lg:max-w-48">
                <img src="{{ asset('img/achieve-01.png') }}" class="w-full" alt="">
            </div>
            <div class="w-full max-w-24 lg:max-w-48">
                <img src="{{ asset('img/achieve-02.png') }}" class="w-full" alt="">
            </div>
        </div>

        <div class="text-white">
            <p class="text-center">CEDEA SEAFOOD diproduksi oleh PT CitraDimensi Arthali yang berkomitmen untuk terus menghasilkan makanan beku dari ikan olahan terbaik dengan penerapan GMP, HACCP, ISO 22000, BPOM, Halal.</p>
        </div>

    </div>
    <div class="w-full lg:w-8/12 mx-auto px-4 lg:px-0">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-0 lg:gap-x-8 mt-8">
            {{-- Article --}}
            <div class="pb-8 flex flex-col space-y-4 lg:space-y-8">
                @foreach ($articles as $item)
                    <div class="relative w-full article-thumbnail-wrapper shadow-2xl group">
                        <div class="inner overflow-hidden rounded-2xl">
                            <img src="{{ $item->media[0]->original_url }}" alt="" class="w-full h-full object-center object-cover group-hover:scale-105 transform transition-all">
                        </div>

                        <div class="ribbon">Berita</div>

                        <div class="absolute inset-x-0 from-black/0 via-black/30 to-black/50 bottom-0 bg-gradient-to-b group-hover:to-black/80 group-hover:via-black/50 via-20% transition-all rounded-b-2xl">
                            <div class="px-8 py-5 space-y-4 flex flex-col justify-center items-center">
                                <h1 class="font-extrabold text-white text-sm lg:text-base text-center">{{ $item->title }}</h1>
                                <p class="text-white text-center text-xs lg:text-base">{{ excerpt_text($item->content) }}</p>

                                <a href="#" class="from-cedea-yellow-1 from-40% to-80% via-cedea-yellow-2 via-50% to-cedea-yellow-1 bg-gradient-to-r px-4 py-2 rounded-full font-base lg:font-extrabold uppercase text-cedea-reddark text-sm lg:text-base">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Recipes --}}
            <div class="pt-8 flex flex-col space-y-8">
                @foreach ($recipes as $item)
                    <div class="relative w-full article-thumbnail-wrapper shadow-2xl group">
                        <div class="inner overflow-hidden rounded-2xl">
                            <img src="{{ $item->media[0]->original_url }}" alt="" class="w-full h-full object-center object-cover group-hover:scale-105 transform transition-all">
                        </div>

                        <div class="ribbon">Kreasi Resep</div>

                        <div class="absolute inset-x-0 from-black/0 via-black/30 to-black/50 bottom-0 bg-gradient-to-b group-hover:to-black/80 group-hover:via-black/50 via-20% transition-all rounded-b-2xl">
                            <div class="px-8 py-5 space-y-4 flex flex-col justify-center items-center">
                                <h1 class="font-extrabold text-white text-sm lg:text-base text-center">{{ $item->title }}</h1>
                                <p class="text-white text-center text-xs lg:text-base">{{ excerpt_text($item->content) }}</p>

                                <a href="#" class="from-cedea-yellow-1 from-40% to-80% via-cedea-yellow-2 via-50% to-cedea-yellow-1 bg-gradient-to-r px-4 py-2 rounded-full font-base lg:font-extrabold uppercase text-cedea-reddark text-sm lg:text-base">Intip Resepnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Marketplace Section --}}
<section class="pb-6 lg:pb-0 pt-8 xl:pt-10 bg-center bg-no-repeat bg-cover" style="background-image: url({{asset('img/market-pattern-100.jpg')}})">
    <div class="container">
        <div class="grid grid-cols-5 px-4 lg:px-0">
            <div class="col-span-2 hidden lg:block">
                <img src="{{ asset('img/marketplace-obj.png') }}" alt="" class="w-full">
            </div>
            <div class="col-span-5 lg:col-span-3">
                <div class="flex flex-col justify-center h-full">
                    <h2 class="font-bold text-2xl lg:text-4xl text-center text-cedea-red">Nggak Ada Waktu Belanja?</h2>
                    <h2 class="font-black text-2xl lg:text-5xl text-center text-cedea-red">Pesan Online Solusinya!</h2>
                    <div class="flex justify-center items-end space-x-2 lg:space-x-8 mt-4 lg:mt-8">
                        <div class="h-14 lg:h-[5rem]">
                            <img src="{{ asset('img/Marketplace/shopee.png') }}" class="h-full w-auto" alt="">
                        </div>
                        <div class="h-14 lg:h-[5rem]">
                            <img src="{{ asset('img/Marketplace/tokopedia.png') }}" class="h-full w-auto" alt="">
                        </div>
                        <div class="h-14 lg:h-[5rem]">
                            <img src="{{ asset('img/Marketplace/grabmart.png') }}" class="h-full w-auto" alt="">
                        </div>
                    </div>
                    <div class="flex justify-center items-end space-x-2 lg:space-x-8 mt-3 lg:mt-6">
                        <div class="h-5 lg:h-10">
                            <img src="{{ asset('img/Marketplace/blibli.png') }}" class="h-full w-auto" alt="">
                        </div>
                        <div class="h-5 lg:h-10">
                            <img src="{{ asset('img/Marketplace/indomaret.png') }}" class="h-full w-auto" alt="">
                        </div>
                        <div class="h-5 lg:h-10">
                            <img src="{{ asset('img/Marketplace/sayurbox.png') }}" class="h-full w-auto" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('plugin-scripts')
    @vite(['resources/js/vendor/swiper-home.js'])
    @vite(['resources/js/vendor/aos-home.js'])

    <style>
        :root{
            --swiper-pagination-bottom: 10px;
        }

        .swiper-pagination-bullets .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            border: 1px solid white;
            opacity: 1;
            background-color: transparent;
        }

        .swiper-pagination-bullets .swiper-pagination-bullet.swiper-pagination-bullet-active{
            background-color: white;
            border: 0px;
        }

        @media screen (min-width: 1024px){
            :root{
                --swiper-pagination-bottom: 60px;
            }

            .swiper-pagination-bullets .swiper-pagination-bullet {
                width: 20px;
                height: 20px;
                border: 2px solid white;
            }
        }
    </style>
@endpush

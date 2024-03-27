

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
                <img src="{{ asset('img/banner-2.jpg') }}" class="w-full">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('img/banner-1-100.jpg') }}" class="w-full">
            </div>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>
</section>

{{-- About Section --}}
<section class="py-8 xl:py-10 relative">
    <div class="container space-y-8 flex flex-col">
        <div class="grid grid-cols-12 gap-x-0 lg:gap-x-6 items-center px-4 lg:px-0">
            <div class="col-span-2 hidden lg:block">
                <img src="{{ asset('img/ikan/left-1.png') }}" alt="">
                <img src="{{ asset('img/ikan/left-2.png') }}" alt="">
                <img src="{{ asset('img/ikan/left-3.png') }}" alt="">
            </div>
            <div class="col-span-12 lg:col-span-8 flex flex-col space-y-4 lg:space-y-8 ">
                <div class="text-center text-cedea-red cedea-title">Kenali Lebih Dekat</div>
                <div class="max-w-4xl mx-auto relative flex flex-col md:flex-row space-x-0 lg:space-x-8 w-full items-center space-y-4 lg:space-y-0">
                    <div class="w-2/5 hidden lg:block">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 199.19 57.28" class="w-full">
                            <g>
                              <g>
                                <path d="m55.84,56.55c2.66-.07,9.22-.13,14.68-.13,3.87,0,7.39,0,9.52.13.13,0,.27-.07.33-.2.13-.47.33-1.4.4-2.07-.07-.2-.47-.47-.73-.47-2.06.21-4.86.34-9.72.34-1.73,0-2.85-.18-3.86-.27-5.99-.49-5.76-1.4-5.83-3.46-.13-3.26-.13-9.65-.13-14.65,0-.13,4.03-.26,9.49-.26,2.6,0,4.46.13,5.92.26.33,0,.6-.06.73-.33.26-.8.4-1.33.47-2.2,0-.2-.07-.27-.27-.27-1.47.2-4,.27-6.86.27-5.46,0-9.49-.06-9.49-.27,0-5.26,0-10.52.13-17.17,0-.2,4.23-.27,9.23-.27,4.06,0,6.19.13,8.79.34.33,0,.66-.07.73-.34-.07-.8-.14-1.46-.33-2.19-.07-.14-.2-.2-.33-.2-2.4.14-5,.14-8.85.14-4.13,0-10.49,0-14.02-.14-.14,0-.26.07-.26.27.13,5.99.26,14.51.26,21.43s-.14,15.44-.26,21.44c0,.2.13.27.26.27" class="fill-cedea-red"/>
                                <path d="m99.41,56.82c14.05,0,25.56-9.19,25.56-24.9,0-13.25-8.79-19.04-24.03-19.04-11.52,0-14.71.33-14.71.66.13,5.99.26,14.38.26,21.3s-.07,16.18-.26,21.3c0,.4,1.93.67,13.18.67m-8.25-41.41c0-.2,1.73-.27,9.65-.27,10.79,0,18.57,6.06,18.57,18.24,0,14.44-8.52,21.17-18.44,21.17-8.46,0-9.45-1.13-9.52-2.86-.27-4.99-.27-9.19-.27-16.84V15.41Z" class="fill-cedea-red"/>
                                <path d="m180.56,35.27c2.61,6.53,6.12,15.17,7.74,20.63.16.33.33.41.82.49,1.71.17,4.24.17,7.09.17.33,0,.65-.33.57-.66-7.42-14.1-16.31-36.29-22.83-53.16-.32-.57-1.39-.57-1.71,0-8.97,22.66-13.61,34.38-21.61,51.29-1.72.08-3.87.13-6.77.13-1.73,0-2.85-.18-3.86-.27-5.99-.49-5.76-1.4-5.83-3.46-.13-3.26-.13-9.65-.13-14.65,0-.13,4.03-.26,9.49-.26,2.59,0,4.46.13,5.92.26.33,0,.6-.06.73-.33.27-.8.4-1.33.47-2.2,0-.2-.07-.26-.26-.26-1.47.2-4,.26-6.86.26-5.46,0-9.49-.06-9.49-.26,0-5.26,0-10.52.13-17.17,0-.21,4.23-.27,9.23-.27,4.06,0,6.19.13,8.79.34.33,0,.67-.07.73-.34-.07-.8-.14-1.46-.33-2.19-.07-.14-.2-.2-.33-.2-2.4.14-4.99.14-8.85.14-4.13,0-10.49,0-14.02-.14-.14,0-.27.07-.27.27.13,5.99.27,14.51.27,21.43s-.14,15.45-.27,21.44c0,.2.13.27.27.27,2.66-.07,9.22-.16,14.68-.13,4.66.02,6.94,0,8.84,0,.49.02.86.03,1.28.03.43.06.9-.47.9-.55,1.22-4.15,4.94-14.35,7.38-20.38.17-.41,1.88-4.48,1.96-4.89,1.79-4.49,4.16-10.52,6.85-16.96.16-.24.4-.24.57,0,3.18,7.67,4.32,10.52,6.93,16.96l1.79,4.65Z" class="fill-cedea-red"/>
                                <path d="m45.54,49.14c.05-.09.1-.2.15-.3l1.1,2.75,3.89-13.25-10.52,8.93,2.17-.08c-.51.5-1.03,1.02-1.6,1.62-3.75,3.91-7.66,5.62-13.44,5.62-12.39,0-20.45-9.94-20.45-27.05,0-13.85,9.88-21.83,18.39-21.83,8.07,0,11.39,2.54,14.4,6.85,3.26,5.19,9.9-.14,2.79-5.71-3.99-2.77-8.15-4.32-15.24-4.32C11.77,2.38,0,13.29,0,30.48c0,15.72,10.76,26.8,25.58,26.8,8.39,0,16.46-3.01,19.96-8.14m-3.15-39.55c.66,0,1.2.54,1.2,1.2s-.54,1.21-1.2,1.21-1.21-.54-1.21-1.21.54-1.2,1.21-1.2" class="fill-cedea-red"/>
                                <path d="m188.48,34.56c-1.3,0-2.54-.29-4.11-.65-.68-.16-1.42-.33-2.23-.49l-.81-.16c-2.45-.5-5.82-1.19-9.3-1.19-6.22,0-10.39,2.26-12.38,6.73l-2.13,4.75,3.58-3.77s4.16-4.28,12.13-4.28c2.94,0,6.07.57,9.29,1.72,1.34.46,2.72.7,4.09.7,7.02,0,12.59-6.79,12.59-6.79,0,0-6.18,3.43-10.71,3.43" class="fill-cedea-red"/>
                                <path d="m186.53,5.9c0,2.65,2.15,4.79,4.8,4.79s4.79-2.15,4.79-4.79-2.15-4.8-4.79-4.8-4.8,2.15-4.8,4.8m-1.1,0c0-3.26,2.64-5.9,5.9-5.9s5.89,2.64,5.89,5.9-2.64,5.89-5.89,5.89-5.9-2.64-5.9-5.89m4.56-.46h1.54c.33,0,.58-.03.77-.1s.32-.18.42-.33c.1-.15.14-.31.14-.49,0-.26-.09-.47-.28-.63-.19-.17-.48-.25-.88-.25h-1.72v1.79Zm-.72,3.03V3.04h2.4c.48,0,.85.05,1.1.15.25.1.45.27.6.52.15.25.23.52.23.82,0,.39-.12.71-.37.97-.25.26-.63.43-1.15.5.19.09.33.18.43.27.21.19.41.43.59.72l.94,1.48h-.9l-.72-1.13c-.21-.33-.38-.57-.52-.75-.14-.17-.26-.29-.36-.36-.11-.07-.22-.12-.33-.15-.08-.02-.21-.02-.4-.02h-.83v2.41h-.72Z" class="fill-cedea-red"/>
                              </g>
                            </g>
                          </svg>
                    </div>
                    <div class="w-full lg:w-3/5">
                        <p class="text-center lg:text-left">PT CitraDimensi Arthali merupakan salah satu perusahaan di Indonesia yang bergerak di bidang pengolahan hasil perikanan dan manufaktur frozen seafood dengan brand CEDEA yang berlokasi di Muara Baru, Jakarta Utara. Berdiri sejak 1995, PT CitraDimensi Arthali juga merupakan pelopor industri makanan olahan berbasis hasil laut. </p>
                    </div>

                </div>
                <a href="{{ route('about') }}" class="rounded-full px-4 py-2 bg-cedea-red text-white font-medium lg:font-semibold text-base lg:text-xl inline-flex self-center">
                    Baca Selengkapnya
                </a>
            </div>
            <div class="col-span-2 hidden lg:block">
                <img src="{{ asset('img/ikan/right-1.png') }}" alt="">
                <img src="{{ asset('img/ikan/right-2.png') }}" alt="">
                <img src="{{ asset('img/ikan/right-3.png') }}" alt="">
                <img src="{{ asset('img/ikan/right-3.png') }}" alt="">
            </div>

        </div>
    </div>

</section>

{{-- Produk Section --}}
<section class="pb-8 lg:pb-0 pt-4 md:pt-8 xl:pt-10 relative">
    <div class="container space-y-4 lg:space-y-8 flex flex-col">
        <div class="text-center text-cedea-red cedea-title">Produk</div>
        <h4 class="text-center text-cedea-red">Jelajahi kekayaan laut dengan rangkaian produk terbaik dari Cedea Seafood!</h4>
        <div class="max-w-full lg:max-w-4xl mx-auto relative flex w-full items-center justify-center space-x-0 lg:space-x-8 px-4 lg:px-0">
            @foreach ($categories as $item)
                <div class="w-1/2 lg:w-2/6">
                    <img src="{{ $item->media[0]->original_url }}" alt="" class="w-full">
                </div>
            @endforeach
        </div>
    </div>

    <div class="text-center relative container pt-8 hidden lg:block">
        <img src="{{ asset('img/product-line.webp') }}" alt="" class="w-full translate-y-4 transform">
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

                                <a href="#" class="from-cedea-yellow-1 from-40% to-80% via-cedea-yellow-2 via-50% to-cedea-yellow-1 bg-gradient-to-r px-4 py-2 rounded-full font-base lg:font-semibold text-cedea-reddark text-sm lg:text-base">Baca Selengkapnya</a>
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

                                <a href="#" class="from-cedea-yellow-1 from-40% to-80% via-cedea-yellow-2 via-50% to-cedea-yellow-1 bg-gradient-to-r px-4 py-2 rounded-full font-base lg:font-semibold text-cedea-reddark text-sm lg:text-base">Baca Selengkapnya</a>
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
        <div class="gap-x-0 lg:gap-x-6 grid grid-cols-5 px-4 lg:px-0">
            <div class="col-span-2 hidden lg:block">
                <img src="{{ asset('img/marketplace-obj.png') }}" alt="" class="w-full">
            </div>
            <div class="col-span-5 lg:col-span-3">
                <h2 class="font-bold text-2xl lg:text-4xl text-center lg:text-right text-cedea-red">Nggak Ada Waktu Belanja?</h2>
                <h2 class="font-black text-2xl lg:text-5xl text-center lg:text-left text-cedea-red">Pesan Online Solusinya!</h2>

                <div class="flex justify-center items-end space-x-2 lg:space-x-8 mt-4 lg:mt-8">
                    <div class="h-14 lg:h-16">
                        <img src="{{ asset('img/Marketplace/shopee.png') }}" class="h-full w-auto" alt="">
                    </div>
                    <div class="h-14 lg:h-16">
                        <img src="{{ asset('img/Marketplace/tokopedia.png') }}" class="h-full w-auto" alt="">
                    </div>
                    <div class="h-14 lg:h-16">
                        <img src="{{ asset('img/Marketplace/grabmart.png') }}" class="h-full w-auto" alt="">
                    </div>
                </div>

                <div class="flex justify-center items-end space-x-2 lg:space-x-8 mt-3 lg:mt-6">
                    <div class="h-5 lg:h-8">
                        <img src="{{ asset('img/Marketplace/blibli.png') }}" class="h-full w-auto" alt="">
                    </div>
                    <div class="h-5 lg:h-8">
                        <img src="{{ asset('img/Marketplace/indomaret.png') }}" class="h-full w-auto" alt="">
                    </div>
                    <div class="h-5 lg:h-8">
                        <img src="{{ asset('img/Marketplace/sayurbox.png') }}" class="h-full w-auto" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('plugin-scripts')
    @vite(['resources/js/vendor/swiper-home.js'])

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

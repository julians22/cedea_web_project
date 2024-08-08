<!-- Slider main container -->
<div x-data="{ width: 0, height: 0, headerHeight: 0, header: document.querySelector('header') }"
    x-resize.document="width = $width; height = $height; headerHeight = header.getBoundingClientRect()['height'];"
    :style="`height: ${width>1024 ? 'calc(100dvh - ' + Math.floor(headerHeight)+'px)': 'auto'};`">
    <!-- Additional required wrapper -->
    <div class="swiper h-full bg-cedea-red-500" id="home-swiper">
        <div class="swiper-wrapper">
            <!-- Slides -->
            @php
                $banners = [
                    [
                        'desktop' => asset('placeholder/banner/banner-1-desktop.jpg'),
                        'mobile' => asset('placeholder/banner/banner-1-mobile.jpg'),
                    ],
                    [
                        'desktop' => asset('placeholder/banner/banner-2-desktop.png'),
                        'mobile' => asset('placeholder/banner/banner-2-desktop.png'),
                    ],
                ];
            @endphp

            @foreach ($banners as $banner)
                <div class="swiper-slide cursor-grab">
                    <img class="slider-item-desktop" src="{{ $banner['desktop'] }}">
                    <img class="block w-full lg:hidden" src="{{ $banner['mobile'] }}">
                </div>
            @endforeach
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>


@push('plugin-scripts')
    @vite(['resources/js/vendor/swiper-home.js'])

    <style>
        :root {
            --swiper-pagination-bottom: 10px;
        }

        .swiper-pagination-bullets .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            border: 1px solid white;
            opacity: 1;
            background-color: transparent;
        }

        .swiper-pagination-bullets .swiper-pagination-bullet.swiper-pagination-bullet-active {
            background-color: white;
            border: 0px;
        }

        @media screen (min-width: 1024px) {
            :root {
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

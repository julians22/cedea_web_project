<!-- Slider main container -->
<div class="" x-data="{ width: 0, height: 0, headerHeight: 0, header: document.querySelector('header') }"
    x-resize.document="width = $width; height = $height; headerHeight = header.getBoundingClientRect()['height']; homeSwiper.update()"
    :style="`height: ${width>1024 ? 'calc(100dvh - ' + Math.floor(headerHeight)+'px': 'auto'});`">
    <!-- Additional required wrapper -->
    <div class="swiper home-swiper h-full">
        <div class="swiper-wrapper">
            <!-- Slides -->
            @for ($i = 0; $i < 3; $i++)
                <div class="swiper-slide">
                    <img class="hidden h-full w-full object-cover lg:block" src="{{ asset('img/banner-3.jpg') }}">
                    <img class="block w-full lg:hidden" src="{{ asset('img/banner-mobile-2.jpg') }}">
                </div>
            @endfor
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>


@push('plugin-scripts')
    @vite(['resources/js/vendor/swiper-home.js'])
    @vite(['resources/js/vendor/aos-home.js'])

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

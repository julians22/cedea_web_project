<!-- Slider main container -->
<div class="swiper home-swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide">
            <img class="hidden w-full sm:block" src="{{ asset('img/banner-2.jpg') }}">
            <img class="block w-full sm:hidden" src="{{ asset('img/banner-mobile-2.jpg') }}">
        </div>
        <div class="swiper-slide">
            <img class="hidden w-full sm:block" src="{{ asset('img/banner-2.jpg') }}">
            <img class="block w-full sm:hidden" src="{{ asset('img/banner-mobile-2.jpg') }}">
        </div>
        <div class="swiper-slide">
            <img class="hidden w-full sm:block" src="{{ asset('img/banner-2.jpg') }}">
            <img class="block w-full sm:hidden" src="{{ asset('img/banner-mobile-2.jpg') }}">
        </div>
    </div>

    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>
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

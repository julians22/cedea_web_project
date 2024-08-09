<!-- Slider main container -->
<div>
    <!-- Additional required wrapper -->
    <div class="swiper h-full bg-cedea-red-500" id="home-swiper">
        <div class="swiper-wrapper">
            <!-- Slides -->
            @foreach ($banners as $banner)
                <div class="swiper-slide cursor-grab">
                    <picture>
                        <source class="block w-full" srcset="{{ $banner->getFirstMediaUrl('banner_desktop') }}"
                            media="(min-width: 1024px)" />
                        <img class="mx-auto block h-full w-full object-cover"
                            src="{{ $banner->getFirstMediaUrl('banner_mobile') }}" alt="Baby Sleeping" />
                    </picture>
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

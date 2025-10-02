{{--
banners: array, Collection
types: default, news, parallax.v1, parallax.v2
--}}

@props(['banners' => [], 'type' => 'default'])



<!-- Slider main container -->
<section>
    <!-- Additional required wrapper -->

    {{-- @dd($banners) --}}
    <div id="header-banner" {{ $attributes->twMerge('swiper h-full bg-cedea-red-500') }}>
        <div {{ $attributes->twMergeFor('wrapper', 'swiper-wrapper') }}>
            <!-- Slides -->
            @foreach ($banners as $banner)
                <div class="swiper-slide h-auto cursor-grab">
                    <x-dynamic-component class="mt-4"
                        component="{{ 'banner.' . ($banner->type->value === \App\Enums\BannerType::DEFAULT->value ? $banner->type->value : $type) }}"
                        :item='$banner' />
                </div>
            @endforeach
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>
</section>


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

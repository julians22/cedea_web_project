<div class="swiper relative via-white/50 after:pointer-events-none after:absolute after:right-0 after:top-0 after:z-1 after:h-full after:w-1/2 after:bg-gradient-to-l after:from-white/80"
    id="recipe-swiper">
    <div class="swiper-wrapper">
        <!-- Slides -->
        @for ($i = 0; $i < 14; $i++)
            <div class="swiper-slide cursor-grab">
                <img class="" src="{{ asset('placeholder/product.png') }}">
            </div>
        @endfor
    </div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
</div>


@push('plugin-scripts')
    @vite(['resources/js/vendor/swiper-recipe.js'])
@endpush

<div class="swiper relative via-white/50 after:pointer-events-none after:absolute after:right-0 after:top-0 after:z-1 after:h-full after:w-1/2 after:bg-gradient-to-l after:from-white/80"
    id="recipe-swiper">
    <div class="swiper-wrapper">
        <!-- Slides -->
        @if ($products)
            @foreach ($products as $product)
                @for ($i = 0; $i < 5; $i++)
                    <div @class(['swiper-slide cursor-pointer']) wire:click="handleChangeActiveProduct('{{ $product->slug }}')">
                        <img class="" src="{{ $product->media[0]->original_url }}">
                    </div>
                @endfor
            @endforeach
        @endif
    </div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
</div>


@push('plugin-scripts')
    @vite(['resources/js/vendor/swiper-recipe.js'])
@endpush

<x-layouts.app>

    @if ($recipe->video['url'])
        <div class="relative aspect-video overflow-hidden">
            <x-matinee::embed :data="$recipe->video" />
            <div class="absolute right-1/2 inline-flex translate-x-1/2 text-white ~bottom-4/20 ~gap-1/4">
                <span class="~size-3/6">
                    <x-icon.mouse />
                </span>
                <p class="~text-base/lg">Scroll</p>
            </div>
        </div>
    @endif

    <section @class([
        'container my-8',
        'grid gap-x-4 gap-y-8  md:grid-cols-[30%_1fr]' => $recipe->product,
        'mt-20' => !$recipe->video['url'],
    ])>
        @if ($recipe->product)
            <div class="flex w-full flex-col items-center gap-y-4">
                <img src="{{ $recipe->product->getFirstMediaUrl('packaging') }}" alt="">

                <a class="w-max rounded-full bg-cedea-red-400 px-8 py-2 uppercase text-white ~text-sm/base"
                    target="_blank" href="{{ $recipe->product->buy_link }}">{{ __('product.buy') }}</a>

            </div>
        @endif
        <div class="flex flex-col gap-y-8">
            <div class="flex flex-col gap-2">
                @if ($recipe->product)
                    <p class="uppercase ~text-base/2xl">{{ $recipe->product->name }}</p>
                @endif
                <h1 class="~text-2xl/5xl">{{ $recipe->title }}</h1>
            </div>
            <div class="prose [&_ul_*]:m-0">
                @if ($recipe->ingredients)
                    @foreach ($recipe->ingredients as $ingredient)
                        <div>
                            <p>{{ $ingredient['title'] }}</p>
                            <ul>
                                @foreach ($ingredient['ingredient_group'] as $item)
                                    <li>{{ $item['unit'] }} {{ $item['name'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                @endif

                {!! $recipe->content !!}

            </div>
        </div>
    </section>

    <hr class="container my-8 h-0.5 border-0 bg-gray-200">

    {{-- recipe --}}
    <section class="container mt-8">
        <h2 class="section-title">{!! __('product.creation.title') !!}</h2>

        <p>{{ __('product.creation.detail') }}</p>

        <div>

            @php
                $times = [
                    [
                        'label' => __('meal.breakfast'),
                        'icon' => asset('img/icons/time/sarapan.svg'),
                        'background' => asset('img/time/sarapan.jpg'),
                        'recipe_type' => \App\Enums\RecipeType::BREAKFAST->value,
                    ],
                    [
                        'label' => __('meal.lunch'),
                        'icon' => asset('img/icons/time/makan_siang.svg'),
                        'background' => asset('img/time/makan_siang.jpg'),
                        'recipe_type' => \App\Enums\RecipeType::LUNCH->value,
                    ],
                    [
                        'label' => __('meal.dinner'),
                        'icon' => asset('img/icons/time/makan_malam.svg'),
                        'background' => asset('img/time/makan_malam.jpg'),
                        'recipe_type' => \App\Enums\RecipeType::DINNER->value,
                    ],
                    [
                        'label' => __('meal.snack'),
                        'icon' => asset('img/icons/time/snack.svg'),
                        'background' => asset('img/time/snack.jpg'),
                        'recipe_type' => \App\Enums\RecipeType::SNACK->value,
                    ],
                ];
            @endphp
            <x-meals-container>
                @foreach ($times as $time)
                    <a href="{{ route('recipe', ['type' => $time['recipe_type']]) }}">
                        <x-meal-card class="cursor-pointer" :background="$time['background']" :icon="$time['icon']" :label="$time['label']" />
                    </a>
                @endforeach
            </x-meals-container>
        </div>
    </section>

</x-layouts.app>

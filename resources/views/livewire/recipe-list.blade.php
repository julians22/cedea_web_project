<div class="space-y-8 ~py-20/40" x-data="{ activeProduct: $wire.entangle('activeProduct') }">
    <section class="container">
        <div class="grid grid-cols-1 items-center justify-center ~mb-4/10 ~gap-4/8 md:grid-cols-[auto_1fr]">
            <h1 class="section-title m-0">{!! __('product.creation.title') !!}</h1>
            <div class="relative ~pr-0/20">
                <x-lucide-search class="absolute left-2 top-1/2 size-6 -translate-y-1/2 md:left-3" />
                <input
                    class="block w-full rounded-full border border-black bg-transparent px-1 py-3 ps-10 text-sm placeholder:text-black"
                    id="recipe-search" wire:model.live='keyword' type="search" placeholder="{{ __('recipe.search') }}" />
            </div>
        </div>

        <p>
            {{ __('recipe.subheading') }}
        </p>

        @use('App\Enums\RecipeType')

        @php

            $times = [
                [
                    'label' => __('meal.breakfast'),
                    'icon' => asset('img/icons/time/sarapan.svg'),
                    'background' => asset('img/time/sarapan.jpg'),
                    'recipe_type' => RecipeType::BREAKFAST->value,
                ],
                [
                    'label' => __('meal.lunch'),
                    'icon' => asset('img/icons/time/makan_siang.svg'),
                    'background' => asset('img/time/makan_siang.jpg'),
                    'recipe_type' => RecipeType::LUNCH->value,
                ],
                [
                    'label' => __('meal.dinner'),
                    'icon' => asset('img/icons/time/makan_malam.svg'),
                    'background' => asset('img/time/makan_malam.jpg'),
                    'recipe_type' => RecipeType::DINNER->value,
                ],
                [
                    'label' => __('meal.snack'),
                    'icon' => asset('img/icons/time/snack.svg'),
                    'background' => asset('img/time/snack.jpg'),
                    'recipe_type' => RecipeType::SNACK->value,
                ],
            ];
        @endphp

        <x-meals-container>
            @foreach ($times as $time)
                <div wire:click="handleChangeActiveRecipeType('{{ $time['recipe_type'] }}')">
                    <x-meal-card class="cursor-pointer" :background="$time['background']" :icon="$time['icon']" :label="$time['label']"
                        :selected="$time['recipe_type'] === $activeRecipeType || $activeRecipeType == null" />
                </div>
            @endforeach
        </x-meals-container>
    </section>

    <section class="container ~px-4/60">
        <div class="mb-4">
            @if ($keyword)
                <div class="inline-flex cursor-pointer items-center gap-1 rounded-md bg-cedea-red px-2 py-1 text-white"
                    wire:click="resetFilter('keyword')">
                    <x-lucide-x class="size-4" />
                    <span> {{ __('recipe.keyword') }}:
                        {{ $keyword }}
                    </span>
                </div>
            @endif
            @if ($activeRecipeType && $activeRecipeType != 'all')
                <div class="inline-flex cursor-pointer items-center gap-1 rounded-md bg-cedea-red px-2 py-1 text-white"
                    wire:click="resetFilter('activeRecipeType')">
                    <x-lucide-x class="size-4" />
                    <span>{{ __('recipe.type') }}:
                        {{ $activeRecipeType }}
                    </span>
                </div>
            @endif
            @if ($activeProduct)
                <div class="inline-flex cursor-pointer items-center gap-1 rounded-md bg-cedea-red px-2 py-1 text-white"
                    wire:click="resetFilter('activeProduct')">
                    <x-lucide-x class="size-4" />
                    <span>{{ __('recipe.product') }}:
                        {{ Str::title(str_replace('-', ' ', $activeProduct)) }}
                    </span>
                </div>
            @endif
        </div>

        <div class="flex flex-col ~gap-8/16">
            @forelse ($recipes as $recipe)
                <x-recipe-item :category="$recipe->recipe_type" :name="$recipe->title" :product="$recipe->product ?: null" :slug="$recipe->slug" :imagePath="$recipe->getFirstMediaUrl('featured_image')"
                    :description="$recipe->description" />
            @empty
                <x-placeholder.empty text="{{ __('status.empty') }}" />
            @endforelse
        </div>

        <div class="pt-4">
            {{ $recipes->links('vendor.livewire.cedea', data: ['scrollTo' => false]) }}
        </div>

    </section>

    <section class="container relative overflow-visible font-medium" wire:ignore x-data="{ lengthFromLeft: 0 }"
        x-resize.document="lengthFromLeft = $el.getBoundingClientRect().left">
        <h2 class="section-title">
            {{ __('recipe.slider.title') }}
        </h2>

        <div :style="`margin-right: calc(-${lengthFromLeft}px - 1rem)`">
            <x-recipe-list-product-slider />
        </div>
    </section>
</div>

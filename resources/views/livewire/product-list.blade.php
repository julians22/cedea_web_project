@push('after-scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('hover', () => ({
                    hoverCardHovered: false,
                    hoverCardDelay: 100,
                    hoverCardLeaveDelay: 200,
                    hoverCardTimeout: null,
                    hoverCardLeaveTimeout: null,
                    hoverCardEnter() {
                        clearTimeout(this.hoverCardLeaveTimeout);
                        if (this.hoverCardHovered) return;
                        clearTimeout(this.hoverCardTimeout);
                        this.hoverCardTimeout = setTimeout(() => {
                            this.hoverCardHovered = true;
                        }, this.hoverCardDelay);
                    },
                    hoverCardLeave() {
                        clearTimeout(this.hoverCardTimeout);
                        if (!this.hoverCardHovered) return;
                        clearTimeout(this.hoverCardLeaveTimeout);
                        this.hoverCardLeaveTimeout = setTimeout(() => {
                            this.hoverCardHovered = false;
                        }, this.hoverCardLeaveDelay);
                    },
                    handleProductClick(name) {
                        @production
                        dataLayer.push({
                            'event': 'ProductView',
                            'pagePath': window.location.href,
                            'pageTitle': "Product : " + name,
                        });
                    @endproduction
                }
            }))
        })
    </script>
@endpush


<div>
    <div wire:ignore>
        <x-video-player :loop="false" source_mp4="{{ asset('video/product.mp4') }}" />
    </div>

    <section class="space-y-8 pb-8" x-data="{ modalOpen: false, }" x-resize="width = $width; height = $height">

        {{-- Brand --}}
        <div class="bg-products minh relative min-h-72 object-contain transition-all max-md:mb-4 lg:min-h-[450px]">

            <picture>
                <source class="block w-full" draggable="false" srcset="{{ asset('img/product-section-bg.jpg') }}"
                    media="(min-width: 1024px)" />

                <img draggable="false" src="{{ asset('img/product-section-bg-mobile.jpg') }}" alt="">
            </picture>

            <div class="container absolute ~top-4/8 md:top-1/4 lg:left-[10%] lg:top-1/2 lg:w-1/3 lg:-translate-y-1/2">
                <h1 class="section-title">{{ __('product.product.title') }}</h1>

                <p class="~text-sm/base">{{ __('product.product.detail') }}</p>
                <div class="my-4 mt-8 grid grid-cols-3 ~gap-x-2/8" type="button">
                    @foreach ($this->brandWithUniqueCategories as $brand)
                        <div class="{{ $brand->slug == $activeBrand ? 'lg:scale-110 border shadow-md' : 'shadow-lg' }} flex cursor-pointer items-center justify-center border-cedea-red bg-white transition duration-700 ~rounded-lg/2xl ~p-2/5"
                            type="button" wire:key='{{ $brand->slug }}'
                            wire:click="handleChangeActiveBrand('{{ $brand->slug }}')">
                            <img class="w-full object-contain" src="{{ $brand->getFirstMediaUrl('logo') }}"
                                alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container my-8 flex grid-cols-[25%_1fr] flex-col ~gap-8/20 lg:grid" id="product-list">
            {{-- category side nav --}}
            <div class="top-28 flex h-fit flex-col gap-y-8 rounded-3xl bg-[#ebebec] ~p-4/8 lg:sticky">
                {{-- search form --}}
                <div class="lg:mt-4">
                    <label class="sr-only mb-2 text-sm font-medium" for="default-search">Search</label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                            <x-lucide-search class="size-6 text-black" />
                        </div>

                        <input
                            class="block w-full rounded-full border border-black p-4 ps-10 text-sm placeholder:text-black"
                            id="product-search" wire:model.live='keyword' type="search"
                            placeholder="{{ __('Search product here') }}" />
                    </div>
                </div>

                <div class="flex flex-col gap-y-4 uppercase">
                    @foreach ($this->brandWithUniqueCategories as $brand)
                        <div class="cursor-pointer" wire:key='{{ $brand->slug }}'>
                            <p wire:click="handleChangeActiveBrand('{{ $brand->slug }}')"
                                @class([
                                    '~text-lg/2xl',
                                    'text-cedea-red-dark' => $brand->slug == $activeBrand,
                                ])>
                                {{ $brand->name }}</p>
                            <div @class([
                                'flex flex-col gap-1 overflow-auto transition-all duration-1000',
                                'max-h-40 mt-2' => $brand->slug == $activeBrand,
                                'max-h-0' => $brand->slug != $activeBrand,
                            ])>
                                <label for="{{ $brand->slug }}-all">
                                    <input class="peer hidden" id="{{ $brand->slug }}-all" type="radio"
                                        value="all" wire:loading.attr="disabled" wire:model.live="activeCategory">
                                    <div wire:loading.class='cursor-wait' @class([
                                        'cursor-pointer ~text-sm/base transition-all select-none',
                                        'peer-checked:text-cedea-red-dark peer-checked:border-l-4 peer-checked:border-cedea-red-dark peer-checked:pl-2 peer-checked:font-bold',
                                        'hover:border-l-4 hover:pl-2 border-black border-opacity-0 hover:border-opacity-100',
                                    ])>
                                        {{ __('All') }}
                                    </div>
                                </label>

                                @foreach ($brand->uniqueCategories as $category)
                                    <label wire:key='{{ $category->slug }}'
                                        for="{{ $brand->slug }}-{{ $category->slug }}">
                                        <input class="peer hidden" id="{{ $brand->slug }}-{{ $category->slug }}"
                                            type="radio" value="{{ $category->slug }}" wire:loading.attr="disabled"
                                            wire:model.live="activeCategory">
                                        <div wire:loading.class='cursor-wait' @class([
                                            'cursor-pointer ~text-sm/base transition-all select-none',
                                            'peer-checked:text-cedea-red-dark peer-checked:border-l-4 peer-checked:border-cedea-red-dark peer-checked:pl-2 peer-checked:font-bold',
                                            'hover:border-l-4 hover:pl-2 border-black border-opacity-0 hover:border-opacity-100',
                                        ])>
                                            {{ $category->name }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="mx-auto h-0.5 w-full bg-black last:hidden"></div>
                    @endforeach
                </div>
            </div>

            {{-- product grid --}}
            <div class="flex flex-col gap-4 ~scroll-mt-36/24" id="product-grid">
                <div class="inline-grid grid-cols-2 content-center items-start ~gap-4/12 md:grid-cols-3"
                    wire:loading.delay.long.remove wire:target.except="handleChangeActiveProduct">

                    {{-- TODO: Refactor to component --}}
                    @forelse ($products as $item)
                        {{-- hover trigger --}}
                        <div class="relative flex flex-col gap-8" x-data="hover" @mouseover="hoverCardEnter()"
                            @mouseleave="hoverCardLeave()">
                            <div class="group flex h-full flex-col justify-between drop-shadow-xl transition hover:drop-shadow-lg"
                                wire:key='{{ $item->slug }}'>
                                <div
                                    class="aspect-square transition-transform duration-500 ease-in-out group-hover:-rotate-6 group-hover:scale-105">
                                    <img class="size-ful aspect-square object-contain object-center lg:cursor-pointer"
                                        src="{{ $item->getFirstMediaUrl('packaging', 'preview_cropped') }}"
                                        @click="()=>{
                                            if(width<=1024) return
                                            modalOpen=true;
                                            handleProductClick('{{ $item->name }}');
                                            $wire.handleChangeActiveProduct('{{ $item->slug }}');
                                            }">
                                </div>

                            </div>
                            {{-- hover content --}}
                            <div class="absolute top-full isolate z-10 h-auto w-full cursor-pointer items-center drop-shadow-top before:absolute before:left-1/2 before:-z-1 before:size-8 before:-translate-x-1/2 before:-translate-y-1/2 before:rotate-45 before:rounded-tl-lg before:bg-white before:duration-700"
                                x-show="hoverCardHovered" x-transition x-cloak
                                @click="()=>{
                                    modalOpen=true;
                                    handleProductClick('{{ $item->name }}');
                                    $wire.handleChangeActiveProduct('{{ $item->slug }}');
                                    }">
                                <div
                                    class="flex items-center justify-between gap-2 rounded-xl bg-gradient-to-r from-[#ededed] via-white to-[#ededed] ~px-3/4 ~py-2/3 max-md:flex-col">

                                    <img class="w-16" src="{{ $item->brand->getFirstMediaUrl('logo') }}"
                                        alt="">

                                    <div class="text-pretty text-cedea-red-dark">
                                        {{ implode(' ', [$item->name, $item->size]) }}
                                        {{-- <x-arrow-right class="inline-block lg:hidden" /> --}}
                                    </div>

                                    <div class="cursor-pointer text-cedea-red max-md:hidden">
                                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 17.78 32.83">
                                            <g>
                                                <g style="fill: none; filter: url(#d);">
                                                    <polyline class="fill-none stroke-cedea-red"
                                                        points="1.36 .75 16.72 16.11 .75 32.07"
                                                        style="fill: none; stroke-linecap: round; stroke-miterlimit: 10; stroke-width: 2px;" />
                                                </g>
                                            </g>
                                        </svg>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <x-placeholder.empty label="{{ __('status.empty') }}" />
                    @endforelse
                </div>

                {{--  TODO: exclude activeProductChange --}}
                <div wire:loading.delay.long wire:target.except="handleChangeActiveProduct">
                    <x-product-list-skeleton />
                </div>
                {{ $products->links('vendor.livewire.cedea', data: ['scrollTo' => false]) }}
            </div>

        </div>


        <x-modal-product-detail>


            <div class="pr-2 text-white" wire:loading.remove wire:target='handleChangeActiveProduct'>
                @if ($activeProduct)
                    <p class="uppercase ~text-lg/xl">{{ $activeProduct->brand->name }}</p>
                    <h2 class="mt-2 uppercase ~text-xl/4xl">
                        {{ implode(' ', [$activeProduct->name, $activeProduct->size]) }}</h2>

                    <div class="mt-8 flex gap-6 max-lg:flex-col">
                        <div class="flex basis-1/5 flex-col items-center justify-center gap-y-4">
                            <img src="{{ $activeProduct->getFirstMediaUrl('packaging') }}" alt="">
                            <a class="w-max rounded-full bg-white px-6 py-1 text-sm font-semibold uppercase text-black"
                                target="_blank" href="{{ $activeProduct->buy_link }}">{{ __('product.buy') }}</a>
                        </div>

                        <div class="flex flex-col gap-y-4 text-justify md:grow md:basis-2/5">
                            <div>{!! $activeProduct->description !!}</div>

                            <div>
                                {{ $activeProduct->no_bpom }}
                            </div>

                            @if ($activeProduct->packaging)
                                <div class="overflow-x-auto">
                                    <table class="table">
                                        {{-- <thead class="invisible">
                                                <tr>
                                                    <th>Unit</th>
                                                    <th>size</th>
                                                </tr>
                                            </thead> --}}

                                        <tbody>
                                            @foreach ($activeProduct->packaging as $package)
                                                <tr class="table-row">
                                                    <td>{{ $package['unit'] }}&nbsp;</td>
                                                    <td>:&nbsp;{{ $package['size'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            <div>
                                {{ __('product.froze') }}
                            </div>

                        </div>

                        @if ($activeProduct->have_video)
                            <div class="flex basis-2/5 flex-col items-center gap-y-4">
                                <template x-if="modalOpen">
                                    <div class="relative aspect-video w-full overflow-hidden rounded-lg">
                                        <x-matinee::embed :data="$activeProduct->video_link" />
                                    </div>
                                </template>
                                <a class="w-fit rounded-full bg-white bg-gradient-radial from-[#fdd000] to-[#fdb400] to-50% px-8 py-1 text-sm font-semibold uppercase text-black"
                                    target="_blank" href="{{ $activeProduct->video_link['url'] }}">Tonton
                                    videonya</a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            {{-- skeleton --}}
            <div class="space-y-4 pr-2 text-white" wire:loading wire:target='handleChangeActiveProduct'>

                <x-text-skeleton />
                <x-text-skeleton />

                <div class="grid grid-cols-1 items-center gap-6 lg:grid-cols-3">
                    <x-image-skeleton />

                    <x-paragraph-skeleton />

                    <x-video-skeleton />
                </div>

            </div>

        </x-modal-product-detail>

    </section>


    {{-- recipe --}}
    <section class="container mt-8" wire:ignore>
        <h2 class="section-title">{!! __('product.creation.title') !!}</h2>

        <p>{{ __('product.creation.detail') }}</p>

        <div>
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
                    <a href="{{ route('recipe', ['type' => $time['recipe_type']]) }}">
                        <x-meal-card class="cursor-pointer" :background="$time['background']" :icon="$time['icon']" :label="$time['label']" />
                    </a>
                @endforeach
            </x-meals-container>
        </div>
    </section>
</div>

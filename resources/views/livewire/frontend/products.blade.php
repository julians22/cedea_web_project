<div class="space-y-8">
    {{-- Stop trying to control. --}}
    <div class="relative mx-auto flex w-full max-w-full flex-col items-center justify-center space-x-0 space-y-3 px-4 lg:max-w-2xl lg:flex-row lg:space-x-8 lg:space-y-0 lg:px-0"
        wire:loading.class="loading">
        @foreach ($categories as $category)
            <div class="category-item {{ $activeCategory == $category->slug ? 'active' : '' }}"
                wire:key='{{ $category->slug }}' x-on:click="$wire.toggleActiveCategory('{{ $category->slug }}')">
                <div class="category-box">
                    <img class="mx-auto w-10/12" src="{{ $category->getFirstMediaUrl() }}" alt="">
                </div>
            </div>
        @endforeach
    </div>

    <div class="relative w-full">
        <div class="flex flex-wrap items-center justify-center gap-x-2 gap-y-3 lg:gap-x-4" wire:loading.class="loading"
            wire:loading.class="loading">
            @foreach ($tags as $tag)
                <div class="tag-link {{ $activeTags == $tag->slug ? 'active' : '' }}" wire:key='{{ $tag->slug }}'
                    x-on:click="$wire.toggleActiveTag('{{ $tag->slug }}')">
                    {{ $tag->name }}</div>
            @endforeach
        </div>
    </div>


    <div class="relative w-full pb-20 pt-10">

        @if ($products)
            <div class="grid grid-cols-2 gap-y-6 md:grid-cols-6 md:gap-x-8">
                @foreach ($products as $item)
                    <div class="product-card col-span-2" wire:key='{{ $item->slug }}' x-data="{ showDescription: false }"
                        x-effect="$el.showDescription = showDescription" x-on:mouseleave="showDescription=false">
                        <div class="product-image">
                            <img src="{{ $item->getFirstMediaUrl('products') }}"
                                alt="{{ $item->getFirstMedia('products')->name }}"
                                x-on:mouseover="showDescription=true">
                            <div class="product-title" x-cloak x-show="showDescription" x-transition
                                x-transition:enter.duration.500ms x-transition:leave.duration.400ms
                                x-on:mouseleave="showDescription=false">
                                <div class="grid grid-cols-6 gap-2">
                                    <div class="col-span-2">
                                        <img class="max-w-full"
                                            src="{{ $item->category->getFirstMediaUrl('products') }}" alt="">
                                    </div>
                                    <div class="col-span-3 flex items-center text-cedea-red">
                                        {!! $item->name !!}
                                    </div>

                                    <div class="col-span-1 flex items-center text-2xl text-cedea-red">
                                        <span class="cursor-pointer">
                                            <svg class="h-8" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 17.78 32.83">
                                                <g>
                                                    <g style="fill: none; filter: url(#d);">
                                                        <polyline class="fill-none stroke-cedea-red"
                                                            points="1.36 .75 16.72 16.11 .75 32.07"
                                                            style="fill: none; stroke-linecap: round; stroke-miterlimit: 10; stroke-width: 2px;" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div>Please Wait ...</div>

        @endif

    </div>
</div>

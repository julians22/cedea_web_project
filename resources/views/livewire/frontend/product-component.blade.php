<div class="space-y-8">
    {{-- Stop trying to control. --}}
    <div class="max-w-full lg:max-w-2xl mx-auto relative flex w-full flex-col lg:flex-row items-center justify-center space-x-0 space-y-3 lg:space-y-0 lg:space-x-8 px-4 lg:px-0">
        @foreach ($categories as $item)
            <div class="category-item {{ $activeCategory != null && $activeCategory == $item->slug ? 'active' : '' }}" wire:loading.class="loading" x-on:click="$wire.toggleActiveCategory('{{$item->slug}}')">
                <div class="category-box">
                    <img src="{{ $item->media[0]->original_url }}" alt="" class="w-10/12 mx-auto">
                </div>
            </div>
        @endforeach
    </div>

    <div class="relative w-full">
        <div class="flex flex-wrap items-center justify-center gap-y-3 gap-x-2 lg:gap-x-4">
            @foreach ($tags as $item)
                <div class="tag-link {{ $activeTags != null && $activeTags == $item->slug ? 'active' : '' }}" wire:loading.class="loading"  x-on:click="$wire.toggleActiveTag('{{$item->slug}}')">{{ $item->name }}</div>
            @endforeach
        </div>
    </div>


    <div class="relative w-full pb-20 pt-10">

        @if ($products)
        <div class="grid grid-cols-2 md:grid-cols-6 gap-y-6 md:gap-x-8">
            @foreach ($products as $item)
                <div class="product-card col-span-2"
                    x-data="{showDescription: false}"
                    x-effect="$el.showDescription = showDescription"
                    x-on:mouseover="showDescription=true" x-on:mouseleave="showDescription=false">
                    <div class="product-image">
                        <img src="{{$item->media[0]->original_url}}" alt="{{ $item->media[0]->name }}">
                        <div x-show="showDescription"
                            class="product-title"
                            x-transition
                            x-transition:enter.duration.500ms
                            x-transition:leave.duration.400ms
                            >
                            <div class="grid grid-cols-6 gap-2">
                                <div class="col-span-2">
                                    <img src="{{$item->category->media[0]->original_url}}" alt="" class="max-w-full">
                                </div>
                                <div class="col-span-3 flex items-center text-cedea-red">
                                    {!! $item->name !!}
                                </div>

                                <div class="col-span-1 flex items-center text-cedea-red text-2xl">
                                    <span class="cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 17.78 32.83" class="h-8">
                                            <g>
                                              <g style="fill: none; filter: url(#d);">
                                                <polyline points="1.36 .75 16.72 16.11 .75 32.07" class="stroke-cedea-red fill-none" style="fill: none; stroke-linecap: round; stroke-miterlimit: 10; stroke-width: 2px;"/>
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

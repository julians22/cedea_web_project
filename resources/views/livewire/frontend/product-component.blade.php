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


    <div class="relative w-full">

        @if ($products)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $item)
                <div>
                    <div class="aspect-square hover:-rotate-12 transform">
                        <img src="{{$item->media[0]->original_url}}" alt="{{ $item->media[0]->name }}" class="h-full w-auto mx-auto filter drop-shadow-[2px_2px_6px_black] ">
                    </div>
                </div>
            @endforeach
        </div>

        @else

        <div>Please Wait ...</div>

        @endif

    </div>
</div>

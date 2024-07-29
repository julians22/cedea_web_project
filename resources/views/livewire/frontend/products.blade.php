<div class="space-y-8">

    <section class="bg-products relative object-contain">
        {{-- slider --}}
        <img draggable="false" src="{{ asset('img/product-section-bg.jpg') }}" alt="">

        <div class="container">
            <div class="absolute left-[10%] top-1/2 w-1/3 -translate-y-1/2">
                <h2 class="section-title">Produk</h2>

                <p>Jelajahi kekayaan laut dengan rangkaian
                    produk terbaik dari Cedea Seafood!</p>

                <div class="my-4 grid grid-cols-3 gap-x-8">
                    @foreach ($categories as $category)
                        <div class="{{ $activeCategory == $category->slug ? 'active' : '' }} aspect-square rounded-3xl border-cedea-red bg-white p-4 shadow-lg"
                            wire:key='{{ $category->slug }}'
                            wire:click="$wire.handleChangeCategory('{{ $category->slug }}')">
                            <img class="" src="{{ $category->getFirstMediaUrl('products') }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <section class="container grid grid-cols-[25%_1fr] gap-8">
        {{ $activeProduct }}
        <div class="sticky top-4 mb-4 flex h-fit flex-col gap-y-8 rounded-3xl bg-[#ebebec] p-8"
            wire:loading.class="loading" wire:loading.class="loading">
            @foreach ($tags as $tag)
                <div class="tag-link {{ $activeTags == $tag->slug ? 'active' : '' }}" wire:key='{{ $tag->slug }}'
                    x-on:click="$wire.handleChangeActiveTag('{{ $tag->slug }}')">
                    {{ $tag->name }}</div>
            @endforeach
        </div>

        <x-modal>

            @if ($products)
                <div class="grid grid-cols-2 gap-y-6 md:grid-cols-6 md:gap-x-8">
                    @foreach ($products as $item)
                        <div class="product-card col-span-2"
                            @click="()=>{
                            modalOpen=true;
                            $wire.handleChangeActiveProduct('{{ $item->slug }}')
                        }"
                            wire:key='{{ $item->slug }}' x-data="{ showDescription: false }"
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
                                                src="{{ $item->category->getFirstMediaUrl('products') }}"
                                                alt="">
                                        </div>
                                        <div class="col-span-3 flex items-center text-cedea-red">
                                            {!! $item->name !!}
                                        </div>

                                        <div class="col-span-1 flex items-center text-2xl text-cedea-red">
                                            <span class="cursor-pointer">
                                                <svg class="h-8" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    viewBox="0 0 17.78 32.83">
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


            <x-slot:trigger>
            </x-slot:trigger>

            <x-slot:content>
                <button
                    class="absolute right-0 top-0 z-1 mr-5 mt-5 flex h-8 w-8 items-center justify-center rounded-full text-white hover:bg-gray-50 hover:text-gray-800"
                    @click="modalOpen=false">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="justify-center pr-2 text-white">
                    <div class="max-h-[80vh] max-w-[70vw] overflow-auto md:mt-8 md:max-h-[85vh] md:max-w-[90vw]"
                        wire:replace>
                        <h1>{{ $activeProduct }}</h1>
                    </div>
                </div>
            </x-slot:content>
        </x-modal>
    </section>
</div>

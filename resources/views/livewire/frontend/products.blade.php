@push('after-scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('hover', () => ({
                hoverCardHovered: false,
                hoverCardDelay: 300,
                hoverCardLeaveDelay: 400,
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
                }
            }))
        })
    </script>
@endpush

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


    <section class="container grid grid-cols-[25%_1fr] gap-20 py-8">

        {{-- category side nav --}}
        <div class="sticky top-0 flex h-fit flex-col gap-y-8 rounded-3xl bg-[#ebebec] p-8" wire:loading.class="loading">

            {{-- search form --}}
            <div class="mt-4">
                <label class="sr-only mb-2 text-sm font-medium text-gray-900" for="default-search">Search</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                        <x-lucide-search class="size-6 text-gray-300" />
                    </div>

                    <input
                        class="block w-full rounded-full border border-gray-300 bg-gray-50 p-4 ps-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                        id="default-search" type="search" placeholder="Cari produk di sini" required />

                </div>
            </div>

            @foreach ($tags as $tag)
                <div class="tag-link {{ $activeTags == $tag->slug ? 'active' : '' }}" wire:key='{{ $tag->slug }}'
                    x-on:click="$wire.handleChangeActiveTag('{{ $tag->slug }}')">
                    {{ $tag->name }}</div>
            @endforeach
        </div>


        {{-- product grid --}}
        @if ($products)
            <div class="grid grid-cols-3 gap-20 md:grid-cols-3">
                @foreach ($products as $item)
                    <div class="drop-shadow-xl" x-data="hover" @mouseover="hoverCardEnter()"
                        @mouseleave="hoverCardLeave()" wire:key='{{ $item->slug }}' wire:key='{{ $item->slug }}'>

                        {{-- hover trigger --}}
                        <div class="hover relative z-0 transition-transform duration-700 hover:-rotate-12">
                            <img class="" src="{{ $item->getFirstMediaUrl('products') }}"
                                alt="{{ $item->getFirstMedia('products')->name }}"
                                x-on:mouseover="showDescription=true">
                        </div>

                        <x-modal>
                            <x-slot:trigger>
                                {{-- hover content --}}
                                <div class="absolute left-1/2 top-0 z-30 mt-5 w-[365px] max-w-lg -translate-x-1/2 translate-y-3"
                                    x-show="hoverCardHovered" x-cloak>
                                    <div class="grid h-auto w-full grid-cols-3 items-center space-x-3 rounded-md border border-neutral-200/70 bg-white p-5"
                                        x-show="hoverCardHovered" x-transition>
                                        <div class="col-span-1">
                                            <img class="max-w-full"
                                                src="{{ $item->category->getFirstMediaUrl('products') }}"
                                                alt="">
                                        </div>

                                        <div class="col-span-1 flex items-center text-cedea-red">
                                            {!! $item->name !!}
                                        </div>

                                        <div class="col-span-1 flex items-center text-2xl text-cedea-red"
                                            @click="modalOpen=true">
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
                            </x-slot:trigger>

                            <x-slot:content>
                                <button
                                    class="absolute right-0 top-0 z-1 mr-5 mt-5 flex h-8 w-8 items-center justify-center rounded-full text-white hover:bg-gray-50 hover:text-gray-800"
                                    @click="modalOpen=false">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                <div class="justify-center pr-2 text-white">
                                    <div
                                        class="max-h-[80vh] max-w-[70vw] overflow-auto md:mt-8 md:max-h-[85vh] md:max-w-[90vw]">
                                        <h1>{{ $item->name }}</h1>
                                    </div>
                                </div>
                            </x-slot:content>
                        </x-modal>
                    </div>
                @endforeach
            </div>
        @else
            <div>Please Wait ...</div>
        @endif

    </section>
</div>

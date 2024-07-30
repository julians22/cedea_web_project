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
                }
            }))
        })
    </script>
@endpush

<div class="space-y-8">

    <section class="bg-products relative object-contain transition-all">
        {{-- slider --}}
        <img draggable="false" src="{{ asset('img/product-section-bg.jpg') }}" alt="">

        <div class="container">
            <div class="absolute left-[10%] top-1/2 w-1/3 -translate-y-1/2">
                <h2 class="section-title">Produk</h2>

                <p>Jelajahi kekayaan laut dengan rangkaian
                    produk terbaik dari Cedea Seafood!</p>

                <div class="my-4 grid grid-cols-3 gap-x-8">
                    @foreach ($categories as $category)
                        <div class="{{ $activeCategory == $category->slug ? 'active' : '' }} flex aspect-square items-center justify-center rounded-3xl border-cedea-red bg-white p-8 shadow-lg"
                            wire:key='{{ $category->slug }}'
                            wire:click="$wire.handleChangeCategory('{{ $category->slug }}')">
                            <img class="size-full" src="{{ $category->getFirstMediaUrl('products') }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <section class="container grid grid-cols-[25%_1fr] gap-20 py-8">

        {{-- category side nav --}}
        <div class="sticky top-4 flex h-fit flex-col gap-y-8 rounded-3xl bg-[#ebebec] p-8" wire:loading.class="loading">

            {{-- search form --}}
            <div class="mt-4">
                <label class="sr-only mb-2 text-sm font-medium" for="default-search">Search</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                        <x-lucide-search class="size-6 text-black" />
                    </div>

                    <input
                        class="block w-full rounded-full border border-black p-4 ps-10 text-sm placeholder:text-black"
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
            <div class="grid grid-cols-3 items-start gap-20 md:grid-cols-3">
                @foreach ($products as $item)
                    <div class="relative drop-shadow-xl" x-data="hover" @mouseover="hoverCardEnter()"
                        @mouseleave="hoverCardLeave()" wire:key='{{ $item->slug }}' wire:key='{{ $item->slug }}'>

                        {{-- hover trigger --}}
                        <div class="transition-transform hover:-rotate-6">
                            <img class="" src="{{ $item->getFirstMediaUrl('products') }}"
                                alt="{{ $item->getFirstMedia('products')->name }}">
                        </div>

                        <x-modal class="max-w-[75vw] lg:w-[80vw] lg:max-w-screen-xl">
                            <x-slot:trigger>
                                {{-- hover content --}}
                                <div class='before:size-12 relative mt-5 rounded-3xl drop-shadow-top before:absolute before:-top-1/2 before:left-1/2 before:-z-1 before:-translate-x-1/2 before:translate-y-1/2 before:rotate-45 before:rounded-lg before:bg-white'
                                    x-show="hoverCardHovered" x-cloak>
                                    <div class="mt-10 grid h-auto w-full grid-cols-[15%_1fr_15%] items-center space-x-3 rounded-3xl bg-white p-5"
                                        x-transition>

                                        <div class="">
                                            <img class="max-w-full"
                                                src="{{ $item->category->getFirstMediaUrl('products') }}"
                                                alt="">
                                        </div>

                                        <div class="flex items-center text-cedea-red">
                                            {{ $item->name }}
                                        </div>

                                        <div class="flex items-center text-2xl text-cedea-red" @click="modalOpen=true">
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
                                <div class="space-y-4 pr-2 text-white">
                                    <p class="uppercase ~text-lg/xl">{{ $item->name }}</p>
                                    <h2 class="uppercase ~text-3xl/5xl">{{ $item->name }}</h2>

                                    <div class="flex gap-x-6">
                                        <div class="flex basis-1/6 flex-col items-center justify-center">
                                            <img src="{{ $item->getFirstMediaUrl('products') }}" alt="">
                                            <button
                                                class="w-fit rounded-full bg-white px-8 py-1 uppercase text-black">Beli
                                                sekarang</button>
                                        </div>

                                        <div class="text-lg/xl basis-3/6 text-justify">
                                            {!! $item->description !!}
                                        </div>

                                        <div class="flex basis-2/6 flex-col">
                                            <div class="relative">
                                                <img class="h-full w-full object-center"
                                                    src="{{ asset('img/video-thumb-small-placeholder.jpg') }}"
                                                    alt="">
                                                <img class="size-1/4 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"
                                                    src="{{ asset('img/icons/play.svg') }}" alt="">
                                            </div>

                                            <a class="w-fit rounded-full bg-white px-4 py-2 uppercase text-cedea-red"
                                                href="#">
                                                Tonton Videonya
                                            </a>
                                        </div>
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

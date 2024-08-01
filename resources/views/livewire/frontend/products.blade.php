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

<section class="space-y-8" x-data="{ modalOpen: false, }">

    {{-- categories --}}
    <div class="bg-products relative object-contain transition-all">
        <img class="max-md:hidden" draggable="false" src="{{ asset('img/product-section-bg.jpg') }}" alt="">

        <div class="container">
            <div class="md:absolute md:left-[10%] md:top-1/2 md:w-1/3 md:-translate-y-1/2">
                <h2 class="section-title">Produk</h2>

                <p>Jelajahi kekayaan laut dengan rangkaian
                    produk terbaik dari Cedea Seafood!</p>

                <button class="my-4 grid grid-cols-3 ~gap-x-3/8" type="button">
                    @foreach ($categories as $category)
                        <div class="{{ $activeCategory == $category->slug ? 'scale-110 border border-cedea-red shadow-md' : 'shadow-lg' }} flex aspect-square items-center justify-center border-cedea-red bg-white transition duration-700 ~rounded-lg/3xl ~p-2/8"
                            wire:key='{{ $category->slug }}' wire:click="handleChangeCategory('{{ $category->slug }}')">
                            <img class="size-full" src="{{ $category->media[0]->original_url }}" alt="">
                        </div>
                    @endforeach
                </button>
            </div>
        </div>
    </div>

    <div class="container flex grid-cols-[25%_1fr] flex-col gap-20 py-8 lg:grid">

        {{-- category side nav --}}
        <div class="top-4 flex h-fit flex-col gap-y-8 rounded-3xl bg-[#ebebec] p-8 lg:sticky">

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

            {{-- @foreach ($categories as $category)

            @endforeach --}}

            <div class="flex-wrap max-md:flex max-md:gap-4">
                @foreach ($tags as $tag)
                    <div class="tag-link {{ $activeTags == $tag->slug ? 'active' : '' }} max-md:bg-white"
                        wire:key='{{ $tag->slug }}' x-on:click="$wire.handleChangeActiveTag('{{ $tag->slug }}')">
                        {{ $tag->name }}</div>
                @endforeach
            </div>
        </div>

        {{-- product grid --}}
        @if ($products)
            <div class="grid grid-cols-3 items-start ~gap-8/20 md:grid-cols-3">
                @foreach ($products as $item)
                    <div class="relative drop-shadow-xl" x-data="hover" @mouseover="hoverCardEnter()"
                        @mouseleave="hoverCardLeave()" wire:key='{{ $item->slug }}' wire:key='{{ $item->slug }}'>

                        {{-- hover trigger --}}
                        {{-- @dd($item->media[0]->original_url) --}}
                        <div class="transition-transform hover:-rotate-6">
                            <img class="" src="{{ $item->media[0]->original_url }}"
                                alt="{{ $item->media[0]->name }}">
                        </div>

                        <div class='before:size-12 relative mt-5 rounded-3xl drop-shadow-top before:absolute before:-top-1/2 before:left-1/2 before:-z-1 before:-translate-x-1/2 before:translate-y-1/2 before:rotate-45 before:rounded-lg before:bg-white'
                            x-show="hoverCardHovered" x-cloak>
                            <div class="mt-10 grid h-auto w-full grid-cols-[15%_1fr_15%] items-center space-x-3 rounded-3xl bg-white p-5"
                                x-transition>

                                <div class="">
                                    <img class="max-w-full" src="{{ $item->category->media[0]->original_url }}"
                                        alt="">
                                </div>

                                <div class="flex items-center text-cedea-red">
                                    {{ $item->name }}
                                </div>

                                <div class="flex items-center text-2xl text-cedea-red"
                                    @click="()=>{
                                    modalOpen=true;
                                    $wire.handleChangeActiveProduct('{{ $item->slug }}')
                                    }">
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
                @endforeach
            </div>
        @else
            <div>Please Wait ...</div>
        @endif
    </div>


    {{-- pop-up --}}
    @teleport('body')
        <div class="${modalOpen ? 'relative w-auto' : '' } h-auto" @keydown.escape.window="modalOpen = false">

            <div class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center" x-show="modalOpen"
                x-cloak>
                <div class="absolute inset-0 h-full w-full bg-black bg-opacity-40" x-show="modalOpen"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="modalOpen=false">
                </div>
                <div class="relative max-w-[75vw] rounded-lg bg-cedea-red px-7 py-6 sm:max-w-lg sm:rounded-3xl lg:w-[80vw] lg:max-w-7xl"
                    x-show="modalOpen" x-trap.inert.noscroll.noautofocus="modalOpen"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                    <button
                        class="absolute right-0 top-0 z-1 mr-5 mt-5 flex h-8 w-8 items-center justify-center rounded-full text-white hover:bg-gray-50 hover:text-gray-800"
                        @click="modalOpen=false">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="pr-2 text-white" wire:loading.remove wire:target='handleChangeActiveProduct'>
                        @if ($activeProduct)
                            <p class="uppercase ~text-lg/xl">{{ $activeProduct->category->title }}</p>
                            <h2 class="mt-2 uppercase ~text-2xl/4xl">{{ $activeProduct->name }}</h2>

                            <div class="mt-8 flex gap-x-6">
                                <div class="flex basis-1/6 flex-col items-center justify-center gap-y-4">
                                    <img src="{{ $activeProduct->media[0]->original_url }}" alt="">
                                    <button
                                        class="w-fit rounded-full bg-white px-8 py-1 text-sm font-semibold uppercase text-black">Beli
                                        sekarang</button>
                                </div>

                                <div class="text-lg/xl basis-3/6 text-justify">
                                    {!! $item->description !!}
                                </div>

                                <div class="flex basis-2/6 flex-col items-center gap-y-4">
                                    <div class="relative overflow-hidden rounded-xl">
                                        <img class="h-full w-full object-center"
                                            src="{{ asset('img/video-thumb-small-placeholder.jpg') }}" alt="">
                                        <img class="size-1/4 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"
                                            src="{{ asset('img/icons/play.svg') }}" alt="">
                                    </div>

                                    <a
                                        class="w-fit rounded-full bg-white bg-gradient-radial from-[#fdd000] to-[#fdb400] to-50% px-8 py-1 text-sm font-semibold uppercase text-black">Tonton
                                        videonya</a>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- skeleton --}}
                    <div class="space-y-4 pr-2 text-white" wire:loading wire:target='handleChangeActiveProduct'>

                        <x-text-skeleton />
                        <x-text-skeleton />

                        <div class="grid grid-cols-3 items-center gap-x-6">
                            <x-image-skeleton />

                            <x-paragraph-skeleton />

                            <x-video-skeleton />
                        </div>

                    </div>
                </div>
            </div>

        </div>
    @endteleport

</section>

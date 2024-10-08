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

<div>
    <div wire:ignore>
        <x-video-player url="{{ asset('video/product.mp4') }}" />
    </div>

    <section class="space-y-8 pb-8" x-data="{ modalOpen: false, }">
        {{-- Brand --}}
        <div class="bg-products relative object-contain transition-all max-md:mb-4 lg:min-h-[450px]">
            <picture>
                <source class="block w-full" draggable="false" srcset="{{ asset('img/product-section-bg.jpg') }}"
                    media="(min-width: 1024px)" />

                <img draggable="false" src="{{ asset('img/product-section-bg-mobile.jpg') }}" alt="">
            </picture>

            <div class="container absolute ~top-4/8 md:top-1/4 lg:left-[10%] lg:top-1/2 lg:w-1/3 lg:-translate-y-1/2">
                <h1 class="section-title">Produk</h1>

                <p class="~text-sm/base">Jelajahi kekayaan laut dengan rangkaian
                    produk terbaik dari Cedea Seafood!</p>
                <div class="my-4 mt-8 grid grid-cols-3 ~gap-x-2/8" type="button">
                    @foreach ($this->brandWithUniqueCategories as $brand)
                        <div class="{{ $brand->slug == $activeBrand ? 'lg:scale-110 border border-cedea-red shadow-md' : 'shadow-lg' }} flex cursor-pointer items-center justify-center border-cedea-red bg-white transition duration-700 ~rounded-lg/2xl ~p-2/5"
                            type="button" wire:key='{{ $brand->slug }}'
                            wire:click="handleChangeActiveBrand('{{ $brand->slug }}')">
                            <img class="lg:size-full" src="{{ $brand->getFirstMediaUrl('logo') }}" alt="">
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
                            placeholder="Cari produk di sini" />
                    </div>
                </div>

                <div class="flex flex-col gap-y-4 uppercase">
                    @foreach ($this->brandWithUniqueCategories as $brand)
                        <div class="cursor-pointer" wire:key='{{ $brand->slug }}'>
                            <p wire:click="handleChangeActiveBrand('{{ $brand->slug }}')" @class([
                                '~text-lg/2xl',
                                'text-cedea-red' => $brand->slug == $activeBrand,
                            ])>
                                {{ $brand->name }}</p>
                            <div @class([
                                'flex flex-col gap-1 overflow-auto transition-all duration-1000',
                                'max-h-40 mt-2' => $brand->slug == $activeBrand,
                                'max-h-0' => $brand->slug != $activeBrand,
                            ])>
                                @foreach ($brand->uniqueCategories as $category)
                                    <label wire:key='{{ $category->slug }}'
                                        for="{{ $brand->slug }}-{{ $category->slug }}">
                                        <input class="peer hidden" id="{{ $brand->slug }}-{{ $category->slug }}"
                                            type="checkbox" value="{{ $category->slug }}" wire:loading.attr="disabled"
                                            wire:model.live="activeCategories">
                                        <div @class([
                                            'cursor-pointer ~text-sm/base transition-all select-none',
                                            'peer-checked:text-cedea-red peer-checked:border-l-4 peer-checked:border-cedea-red peer-checked:pl-2 peer-checked:font-bold',
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
            <div class="flex flex-col gap-4">
                <div class="grid grid-cols-2 content-center items-start ~gap-4/12 md:grid-cols-3"
                    wire:loading.delay.long.remove wire:target.except="handleChangeActiveProduct">
                    {{-- TODO: Refactor to component --}}
                    @forelse ($products as $item)
                        {{-- hover trigger --}}
                        <div class="flex flex-col gap-8">
                            <div class="group relative flex h-full flex-col justify-between drop-shadow-xl transition hover:drop-shadow-lg"
                                x-data="hover" @mouseover="hoverCardEnter()" @mouseleave="hoverCardLeave()"
                                wire:key='{{ $item->slug }}'>
                                <div
                                    class="aspect-square transition-transform duration-500 ease-in-out group-hover:-rotate-6 group-hover:scale-105">
                                    <img class="size-full aspect-square object-contain object-center"
                                        src="{{ $item->getFirstMediaUrl('packaging') }}" {{-- TODO: THIS DATA SOMETIMES NULL --}}
                                        {{-- alt="{{
                                        $item->getFirstMedia('packaging')->name
                                        }}" --}}>
                                </div>

                                {{-- hover content --}}
                                <div class="before:size-8 top-full mt-10 h-auto w-full cursor-pointer items-center drop-shadow-top before:absolute before:left-1/2 before:-z-1 before:-translate-x-1/2 before:-translate-y-1/2 before:rotate-45 before:rounded-tl-lg before:bg-white before:duration-700"
                                    x-show="hoverCardHovered" x-transition x-cloak
                                    @click="()=>{
                                        modalOpen=true;
                                        $wire.handleChangeActiveProduct('{{ $item->slug }}')
                                        }">
                                    <div
                                        class="flex items-center justify-between gap-2 rounded-xl bg-gradient-to-r from-[#ededed] via-white to-[#ededed] ~px-3/4 ~py-2/3 max-md:flex-col">

                                        <img class="w-16" src="{{ $item->brand->getFirstMediaUrl('logo') }}"
                                            alt="">

                                        <div class="text-cedea-red">
                                            {{ $item->name }}
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
                        </div>
                    @empty
                        <div
                            class="col-span-full flex flex-col items-center justify-center self-center justify-self-center">
                            <lord-icon class="~size-20/40 inline-block" src="https://cdn.lordicon.com/rmkpgtpt.json"
                                trigger="in" delay="500" state="in-reveal"
                                colors="primary:#e4e4e4,secondary:#e4e4e4">
                            </lord-icon>

                            <h2 class="section-title">
                                Data tidak ditemukan
                            </h2>

                        </div>
                    @endforelse
                </div>

                {{--  TODO: exclude activeProductChange --}}
                <div wire:loading.delay.long wire:target.except="handleChangeActiveProduct">
                    <x-product-list-skeleton />
                </div>
                {{ $products->links(data: ['scrollTo' => false]) }}
            </div>

        </div>


        {{-- pop-up --}}
        {{-- TODO: Refactor to dialog element ?  --}}
        @teleport('body')
            <div class="${modalOpen ? 'relative w-auto' : '' } h-auto" @keydown.escape.window="modalOpen = false">
                <div class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center" x-show="modalOpen"
                    x-cloak>

                    <div class="absolute inset-0 h-full w-full bg-black bg-opacity-40" x-show="modalOpen"
                        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="modalOpen=false">
                    </div>

                    <div class="relative max-h-[90dvh] w-[80vw] min-w-[50vw] overflow-auto rounded-lg bg-cedea-red ~p-6/12 sm:max-w-lg sm:rounded-3xl lg:max-w-7xl"
                        x-show="modalOpen" x-trap.inert.noscroll.noautofocus="modalOpen"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                        <button
                            class="absolute right-0 top-0 z-1 mr-5 mt-5 flex items-center justify-center rounded-full text-white hover:bg-gray-50 hover:text-gray-800"
                            @click="modalOpen=false">
                            <svg class="size-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="0.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="pr-2 text-white" wire:loading.remove wire:target='handleChangeActiveProduct'>
                            @if ($activeProduct)
                                <p class="uppercase ~text-lg/xl">{{ $activeProduct->brand->name }}</p>
                                <h2 class="mt-2 uppercase ~text-xl/4xl">{{ $activeProduct->name }}</h2>

                                <div class="mt-8 flex gap-6 max-lg:flex-col">
                                    <div class="flex basis-1/5 flex-col items-center justify-center gap-y-4">
                                        <img src="{{ $activeProduct->getFirstMediaUrl('packaging') }}" alt="">
                                        <a class="w-max rounded-full bg-white px-6 py-1 text-sm font-semibold uppercase text-black"
                                            href="{{ $activeProduct->buy_link }}">Beli
                                            sekarang</a>
                                    </div>

                                    <div class="flex grow basis-2/5 flex-col gap-y-4 text-justify">
                                        <span>{!! $activeProduct->description !!}</span>

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
                                    </div>

                                    @if ($activeProduct->have_video)
                                        <div class="flex basis-2/5 flex-col items-center gap-y-4">
                                            <div class="relative overflow-hidden rounded-xl">
                                                <img class="h-full w-full object-center"
                                                    src="{{ asset('img/video-thumb-small-placeholder.jpg') }}"
                                                    alt="">
                                                <img class="size-1/4 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"
                                                    src="{{ asset('img/icons/play.svg') }}" alt="">
                                            </div>

                                            <a
                                                class="w-fit rounded-full bg-white bg-gradient-radial from-[#fdd000] to-[#fdb400] to-50% px-8 py-1 text-sm font-semibold uppercase text-black">Tonton
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
                    </div>
                </div>
            </div>
        @endteleport

    </section>


    {{-- recipe --}}
    {{-- <section class="container mt-8" wire:ignore>
        <h2 class="section-title">Kreasi Resep <span class="font-montserrat font-semibold">Cedea</span></h2>

        <p>Menghadirkan kesegaran laut dalam setiap gigitan. Jelajahi kekayaan laut dengan rangkaian produk terbaik dari
            Cedea Seafood! Mulai dari
            sarapan pagi hingga malam, temukan tips-tips kuliner yang memikat di setiap sajian.</p>

        <div>
            @php
                $times = [
                    [
                        'label' => 'Sarapan',
                        'icon' => asset('img/icons/time/sarapan.svg'),
                        'background' => asset('img/time/sarapan.jpg'),
                        'recipe_type' => 'sarapan',
                    ],
                    [
                        'label' => 'Makan Siang',
                        'icon' => asset('img/icons/time/makan_siang.svg'),
                        'background' => asset('img/time/makan_siang.jpg'),
                        'recipe_type' => 'makan-siang',
                    ],
                    [
                        'label' => 'Makan Malam',
                        'icon' => asset('img/icons/time/makan_malam.svg'),
                        'background' => asset('img/time/makan_malam.jpg'),
                        'recipe_type' => 'makan-malam',
                    ],
                    [
                        'label' => 'Snack',
                        'icon' => asset('img/icons/time/snack.svg'),
                        'background' => asset('img/time/snack.jpg'),
                        'recipe_type' => 'snack',
                    ],
                ];
            @endphp

            <x-meals-container>
                @foreach ($times as $time)
                    <a href="{{ route('recipe', ['recipe_type' => $time['recipe_type']]) }}">
                        <x-meal-card class="cursor-pointer" :background="$time['background']" :icon="$time['icon']" :label="$time['label']" />
                    </a>
                @endforeach
            </x-meals-container>
        </div>
    </section> --}}
</div>

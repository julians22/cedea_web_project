{{-- ? Main Menu --}}
<div class="menu-wrapper" x-data="{ openNav: false, hoverPosition: null }">

    {{-- ? Burger icon --}}
    <div class="burger-icon-wrapper justify-self-end" :class="{ 'open': openNav }" @click="openNav= !openNav">
        <div class="burger-icon"></div>
    </div>

    {{-- <label class="hamburger">
        <input type="checkbox">
        <svg viewBox="0 0 32 32">
            <path class="line line-top-bottom"
                d="M27 10 13 10C10.8 10 9 8.2 9 6 9 3.5 10.8 2 13 2 15.2 2 17 3.8 17 6L17 26C17 28.2 18.8 30 21 30 23.2 30 25 28.2 25 26 25 23.8 23.2 22 21 22L7 22">
            </path>
            <path class="line" d="M7 16 27 16"></path>
        </svg>
    </label> --}}

    {{-- old nav --}}
    {{-- <div class="menu">
        <div class="menu-item {{ Route::is('about') ? 'active' : '' }}">
    <a class="active" href="{{ route('about') }}" @click.once="hoverPosition = 'about'"
        @focus="hoverPosition = 'about'" @mouseenter="hoverPosition = 'about'">Perusahaan</a>
    <ul class="sub-menu" :class="('about' == hoverPosition) ? 'open' : ''" @click.outside="hoverPosition=null"
        @mouseleave="hoverPosition=null">
        <li class="menu-item">
            <a href="{{ route('about') }}#tentang-cedea">Tentang CEDEA</a>
        </li>
        <li class="menu-item">
            <a href="{{ route('about') }}#sejarah">Sejarah</a>
        </li>
        <li class="menu-item">
            <a href="{{ route('about') }}#visi-misi">Visi & Misi</a>
        </li>
        <li class="menu-item">
            <a href="{{ route('about') }}#sertifikasi">Sertifikasi</a>
        </li>
    </ul>
</div>

<div class="menu-item {{ Route::is('product') ? 'active' : '' }}">
    <a href="{{ route('product') }}" @click.once="hoverPosition = 'product'" @focus="hoverPosition = 'product'"
        @mouseenter="hoverPosition = 'product'">Produk</a>
    <ul class="sub-menu" :class="('product' == hoverPosition) ? 'open' : ''" @click.outside="hoverPosition=null"
        @mouseleave="hoverPosition=null">
        <li class="menu-item">
            <a href="{{ route('product') }}?category=cedea-seafood">CEDEA</a>
        </li>
        <li class="menu-item">
            <a href="{{ route('product') }}?category=teman-laut">Teman Laut</a>
        </li>
        <li class="menu-item">
            <a href="#">Kreasi Resep</a>
        </li>
        <li class="menu-item">
            <a href="#">Video</a>
        </li>
        <li class="menu-item">
            <a href="#">Belanja</a>
        </li>
    </ul>
</div>

<div class="menu-item">
    <a href="#" @click.once="hoverPosition = 'socials'" @focus="hoverPosition = 'socials'"
        @mouseenter="hoverPosition = 'socials'">Tanggung Jawab Sosial</a>
    <ul class="sub-menu" :class="('socials' == hoverPosition) ? 'open' : ''" @click.outside="hoverPosition=null"
        @mouseleave="hoverPosition=null">
        <li class="menu-item">
            <a href="#">Kegiatan Sosial</a>
        </li>
        <li class="menu-item">
            <a href="#">Lingkungan Hidup</a>
        </li>
        <li class="menu-item">
            <a href="#">Ketenagakerjaan, Kesehatan dan Keselamatan Kerja</a>
        </li>
        <li class="menu-item">
            <a href="#">Pengembangan Sosial dan Kemasyarakatan</a>
        </li>
    </ul>
</div>

<div class="menu-item">
    <a href="#" @click.once="hoverPosition = 'news'" @focus="hoverPosition = 'news'"
        @mouseenter="hoverPosition = 'news'">Berita</a>
    <ul class="sub-menu" :class="('news' == hoverPosition) ? 'open' : ''" @click.outside="hoverPosition=null"
        @mouseleave="hoverPosition=null">
        <li class="menu-item">
            <a href="#">Kegiatan</a>
        </li>
        <li class="menu-item">
            <a href="#">Artikel / Blog</a>
        </li>
    </ul>
</div>

<div class="menu-item {{ Route::is('contact') ? 'active' : '' }}" @click.once="hoverPosition = 'contact'"
    @focus="hoverPosition = 'contact'" @mouseenter="hoverPosition = 'contact'">
    <a href="{{ route('contact') }}">Hubungi Kami</a>
</div>
</div> --}}

@php
//* TYPE DOC
//* label : string
//* route : string | route
//* submenu: [
//* label : string
//* route : string | route
//* submenu: [
//* label : string
//* route : string | route
//* ][]
//* ][]

$nav_items = [
'label' => 'perusahaan',
'route' => route('about'),
'submenu' => [
['label' => 'perusahaan',
'route' => '',
'submenu' => [
'label' => 'perusahaan',
'route' => ''
]
],
],
];
@endphp

<nav class="relative z-10 w-auto" x-data="{
        navigationMenuOpen: false,
        navigationMenu: '',
        navigationMenuCloseDelay: 200,
        navigationMenuCloseTimeout: null,
        navigationMenuLeave() {
            let that = this;
            this.navigationMenuCloseTimeout = setTimeout(() => {
                that.navigationMenuClose();
            }, this.navigationMenuCloseDelay);
        },
        navigationMenuReposition(navElement) {
            this.navigationMenuClearCloseTimeout();
            this.$refs.navigationDropdown.style.left = navElement.offsetLeft + 'px';
            this.$refs.navigationDropdown.style.marginLeft = (navElement.offsetWidth / 2) + 'px';
        },
        navigationMenuClearCloseTimeout() {
            clearTimeout(this.navigationMenuCloseTimeout);
        },
        navigationMenuClose() {
            this.navigationMenuOpen = false;
            this.navigationMenu = '';
        }
    }">

    {{-- nav --}}
    <div class="relative">
        <ul
            class="group flex flex-1 list-none items-center justify-center space-x-1 rounded-md border border-neutral-200/80 p-1 text-neutral-700">
            <li>
                <button
                    class="group inline-flex h-10 w-max items-center justify-center rounded-md px-4 py-2 text-sm font-medium transition-colors hover:text-neutral-900 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                    :class="{ 'bg-neutral-100': navigationMenu=='getting-started', 'hover:bg-neutral-100': navigationMenu!='getting-started' }"
                    @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='getting-started'"
                    @mouseleave="navigationMenuLeave()">
                    <span>Getting started</span>
                    <svg class="relative top-[1px] ml-1 h-3 w-3 duration-300 ease-out"
                        :class="{ '-rotate-180': navigationMenuOpen == true && navigationMenu == 'getting-started' }"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
            </li>
            <li>
                <button
                    class="bg-background group inline-flex h-10 w-max items-center justify-center rounded-md px-4 py-2 text-sm font-medium transition-colors hover:bg-neutral-100 hover:text-neutral-900 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                    :class="{ 'bg-neutral-100': navigationMenu=='learn-more', 'hover:bg-neutral-100': navigationMenu!='learn-more' }"
                    @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='learn-more'"
                    @mouseleave="navigationMenuLeave()">
                    <span>Learn More</span>
                    <svg class="relative top-[1px] ml-1 h-3 w-3 duration-300 ease-out"
                        :class="{ '-rotate-180': navigationMenuOpen == true && navigationMenu == 'learn-more' }"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
            </li>
            <li>
                <a class="bg-background group inline-flex h-10 w-max items-center justify-center rounded-md px-4 py-2 text-sm font-medium transition-colors hover:bg-neutral-100 hover:text-neutral-900 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                    href="#_">
                    Documentation
                </a>
            </li>
        </ul>
    </div>

    <div class="absolute top-0 -translate-x-1/2 translate-y-11 pt-3 duration-200 ease-out"
        x-ref="navigationDropdown" x-show="navigationMenuOpen" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90" @mouseover="navigationMenuClearCloseTimeout()"
        @mouseleave="navigationMenuLeave()" x-cloak>

        <div
            class="flex h-auto w-auto justify-center overflow-hidden rounded-md border border-neutral-200/70 bg-white shadow-sm">

            <div class="flex w-full max-w-2xl items-stretch justify-center gap-x-3 p-6"
                x-show="navigationMenu == 'getting-started'">
                <div class="w-48 flex-shrink-0 rounded bg-gradient-to-br from-neutral-800 to-black pb-7 pt-28">
                    <div class="relative space-y-1.5 px-7 text-white">
                        <svg class="block h-9 w-auto" viewBox="0 0 180 180" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M67.683 89.217h44.634l30.9 53.218H36.783l30.9-53.218Z" fill="currentColor" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M77.478 120.522h21.913v46.956H77.478v-46.956Zm-34.434-29.74 45.59-78.26 46.757 78.26H43.044Z"
                                fill="currentColor" />
                        </svg>
                        <span class="block font-bold">Pines UI</span>
                        <span class="block text-sm opacity-60">An Alpine and Tailwind UI library</span>
                    </div>
                </div>
                <div class="w-72">
                    <a class="block rounded px-3.5 py-3 text-sm hover:bg-neutral-100" href="#_"
                        @click="navigationMenuClose()">
                        <span class="mb-1 block font-medium text-black">Introduction</span>
                        <span class="block font-light leading-5 opacity-50">Re-usable elements built using Alpine JS
                            and Tailwind CSS.</span>
                    </a>
                    <a class="block rounded px-3.5 py-3 text-sm hover:bg-neutral-100" href="#_"
                        @click="navigationMenuClose()">
                        <span class="mb-1 block font-medium text-black">How to use</span>
                        <span class="block leading-5 opacity-50">Couldn't be easier. It is as simple as copy, paste,
                            and preview.</span>
                    </a>
                    <a class="block rounded px-3.5 py-3 text-sm hover:bg-neutral-100" href="#_"
                        @click="navigationMenuClose()">
                        <span class="mb-1 block font-medium text-black">Contributing</span>
                        <span class="block leading-5 opacity-50">Feel free to contribute your expertise. All these
                            elements are open-source.</span>
                    </a>
                </div>
            </div>
            <div class="flex w-full items-stretch justify-center p-6" x-show="navigationMenu == 'learn-more'">
                <div class="w-72">
                    <a class="block rounded px-3.5 py-3 text-sm hover:bg-neutral-100" href="#_"
                        @click="navigationMenuClose()">
                        <span class="mb-1 block font-medium text-black">Tailwind CSS</span>
                        <span class="block font-light leading-5 opacity-50">A utility first CSS framework for
                            building amazing websites.</span>
                    </a>
                    <a class="block rounded px-3.5 py-3 text-sm hover:bg-neutral-100" href="#_"
                        @click="navigationMenuClose()">
                        <span class="mb-1 block font-medium text-black">Laravel</span>
                        <span class="block font-light leading-5 opacity-50">The perfect all-in-one framework for
                            building amazing apps.</span>
                    </a>
                    <a class="block rounded px-3.5 py-3 text-sm hover:bg-neutral-100" href="#_"
                        @click="navigationMenuClose()">
                        <span class="mb-1 block font-medium text-black">Pines UI</span>
                        <span class="block leading-5 opacity-50">An Alpine JS and Tailwind CSS UI library for
                            awesome people. </span>
                    </a>
                </div>
                <div class="w-72">
                    <a class="block rounded px-3.5 py-3 text-sm hover:bg-neutral-100" href="#_"
                        @click="navigationMenuClose()">
                        <span class="mb-1 block font-medium text-black">AlpineJS</span>
                        <span class="block font-light leading-5 opacity-50">A framework without the complex setup
                            or heavy dependencies.</span>
                    </a>
                    <a class="block rounded px-3.5 py-3 text-sm hover:bg-neutral-100" href="#_"
                        @click="navigationMenuClose()">
                        <span class="mb-1 block font-medium text-black">Livewire</span>
                        <span class="block leading-5 opacity-50">A seamless integration of server-side and
                            client-side interactions.</span>
                    </a>
                    <a class="block rounded px-3.5 py-3 text-sm hover:bg-neutral-100" href="#_"
                        @click="navigationMenuClose()">
                        <span class="mb-1 block font-medium text-black">Tails</span>
                        <span class="block leading-5 opacity-50">The ultimate Tailwind CSS design tool that helps
                            you craft beautiful websites.</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</nav>


<div class="flex flex-col space-x-0 space-y-4 lg:flex-row lg:space-x-8 lg:space-y-0">
    <button class="text-xl">
        <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36.42 36.41">
            <g>
                <path class="fill-current"
                    d="m15.67.07c1,.09,1.97.29,2.92.59,2.65.84,4.88,2.33,6.67,4.46,2.03,2.43,3.13,5.24,3.32,8.39.06.98.01,1.96-.14,2.93-.36,2.34-1.25,4.47-2.66,6.37q-.22.3.04.56c3.33,3.33,6.66,6.66,9.99,9.99.05.05.1.09.14.14.4.45.55.98.42,1.56-.19.85-1,1.42-1.86,1.32-.43-.05-.77-.24-1.08-.54-2.11-2.12-4.23-4.23-6.35-6.35-1.27-1.27-2.54-2.54-3.81-3.81-.15-.15-.15-.16-.32-.03-2.48,1.87-5.27,2.84-8.37,2.93-.94.03-1.87-.05-2.79-.22-3.23-.6-5.96-2.1-8.15-4.55C1.28,21.17.09,18.04,0,14.5c-.02-.9.05-1.79.22-2.68.6-3.26,2.12-6.02,4.6-8.21C7.51,1.22,10.69.04,14.28,0c.46,0,.93.02,1.39.07ZM3.44,14.29c0,6.04,4.89,10.87,10.86,10.87,5.94,0,10.86-4.78,10.86-10.87,0-6.17-5.04-10.88-10.85-10.85-5.88-.04-10.87,4.75-10.87,10.85Z" />
            </g>
        </svg>
    </button>

    <button class="flex flex-row items-center space-x-2" type="button">
        <span>
            ID
        </span>
        <span class="inline">
            <svg class="inline w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.96 11.07">
                <g>
                    <polyline points="1.5 1.5 7.62 9.57 13.46 1.87"
                        style="fill: none; stroke: #fff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;" />
                </g>
            </svg>
        </span>
    </button>
</div>

</div>

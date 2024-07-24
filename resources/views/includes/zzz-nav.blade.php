<nav class="relative z-20 w-full bg-cedea-red px-4 py-4 text-white lg:px-2" x-data="{ openNav: false, hoverPosition: null }">

    <div class="container mx-auto flex flex-col justify-between lg:flex-row">
        <div class="relative h-14 w-28 lg:h-auto lg:w-40">
            <a class="absolute inset-x-0 -top-4" href="{{ route('home') }}">
                <x-logo />
            </a>
        </div>

        <div class="burger-icon-wrapper" :class="{ 'open': openNav }" @click="openNav= !openNav">
            <div class="burger-icon"></div>
        </div>

        <div class="menu-wrapper" :class="{ 'open': openNav }">
            <div class="menu">
                <div class="menu-item {{ Route::is('about') ? 'active' : '' }}">
                    <a class="active" href="{{ route('about') }}" @click.once="hoverPosition = 'about'"
                        @focus="hoverPosition = 'about'" @mouseenter="hoverPosition = 'about'">Perusahaan</a>
                    <ul class="sub-menu" :class="('about' == hoverPosition) ? 'open' : ''"
                        @click.outside="hoverPosition=null" @mouseleave="hoverPosition=null">
                        <li class="menu-item">
                            <a href="{{ route('about') }}#tentang-cedea">Tentang Cedea</a>
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
                    <a href="{{ route('product') }}" @click.once="hoverPosition = 'product'"
                        @focus="hoverPosition = 'product'" @mouseenter="hoverPosition = 'product'">Produk</a>
                    <ul class="sub-menu" :class="('product' == hoverPosition) ? 'open' : ''"
                        @click.outside="hoverPosition=null" @mouseleave="hoverPosition=null">
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
                    <ul class="sub-menu" :class="('socials' == hoverPosition) ? 'open' : ''"
                        @click.outside="hoverPosition=null" @mouseleave="hoverPosition=null">
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
                    <ul class="sub-menu" :class="('news' == hoverPosition) ? 'open' : ''"
                        @click.outside="hoverPosition=null" @mouseleave="hoverPosition=null">
                        <li class="menu-item">
                            <a href="#">Kegiatan</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Artikel / Blog</a>
                        </li>
                    </ul>
                </div>
                <div class="menu-item {{ Route::is('contact') ? 'active' : '' }}"
                    @click.once="hoverPosition = 'contact'" @focus="hoverPosition = 'contact'"
                    @mouseenter="hoverPosition = 'contact'">
                    <a href="{{ route('contact') }}">Hubungi Kami</a>
                </div>
            </div>

            <div class="flex flex-col space-x-0 space-y-4 lg:flex-row lg:space-x-8 lg:space-y-0">
                <button class="text-xl">
                    <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36.42 36.41">
                        <g>
                            <path class="fill-current"
                                d="m15.67.07c1,.09,1.97.29,2.92.59,2.65.84,4.88,2.33,6.67,4.46,2.03,2.43,3.13,5.24,3.32,8.39.06.98.01,1.96-.14,2.93-.36,2.34-1.25,4.47-2.66,6.37q-.22.3.04.56c3.33,3.33,6.66,6.66,9.99,9.99.05.05.1.09.14.14.4.45.55.98.42,1.56-.19.85-1,1.42-1.86,1.32-.43-.05-.77-.24-1.08-.54-2.11-2.12-4.23-4.23-6.35-6.35-1.27-1.27-2.54-2.54-3.81-3.81-.15-.15-.15-.16-.32-.03-2.48,1.87-5.27,2.84-8.37,2.93-.94.03-1.87-.05-2.79-.22-3.23-.6-5.96-2.1-8.15-4.55C1.28,21.17.09,18.04,0,14.5c-.02-.9.05-1.79.22-2.68.6-3.26,2.12-6.02,4.6-8.21C7.51,1.22,10.69.04,14.28,0c.46,0,.93.02,1.39.07ZM3.44,14.29c0,6.04,4.89,10.87,10.86,10.87,5.94,0,10.86-4.78,10.86-10.87,0-6.17-5.04-10.88-10.85-10.85-5.88-.04-10.87,4.75-10.87,10.85Z" />
                        </g>
                    </svg>
                </button>

                <button class="flex flex-row items-center space-x-2">
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
    </div>
</nav>

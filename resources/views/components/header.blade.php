<header class="relative z-20 w-full bg-cedea-red text-white drop-shadow-lg">
    <div class="container mx-auto grid grid-cols-2 justify-between gap-4 lg:flex">

        {{-- ? logo --}}
        <a class="block h-14 w-28 shadow-lg shadow-black/25 transition-transform duration-700 lg:-mb-16 lg:h-fit lg:w-40"
            id="logo" href="{{ route('home') }}">
            <x-logo />
        </a>

        <x-nav />
    </div>
</header>

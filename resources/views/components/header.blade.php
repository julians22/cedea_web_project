<header class="relative z-20 w-full bg-cedea-red py-4 text-white lg:px-2">
    <div class="container mx-auto grid grid-cols-2 justify-between gap-4 lg:flex">
        {{-- ? logo --}}
        <a class="-mt-8 block h-14 w-28 shadow-lg shadow-black/25 lg:-mb-16 lg:h-auto lg:w-40" href="{{ route('home') }}">
            <x-logo />
        </a>

        <x-nav />
    </div>
</header>

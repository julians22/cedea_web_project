<div class="grid content-center items-center navbar-small:relative" x-data="{ seachModalOpen: false }"
    @keydown.escape="seachModalOpen=false" @click.outside="seachModalOpen=false">
    <button
        class="origin-bottom-left text-xl opacity-60 transition-all disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50"
        :class="{
            'size-0 translate-y-full': seachModalOpen,
            'size-5 translate-y-0': !seachModalOpen
        }"
        @production disabled @endproduction type="button" @click="seachModalOpen=true">
        <x-icon.magnifying-glass class="size-auto" />
    </button>

    <form
        class="min-w-28 min-h-8 absolute right-4 top-full z-10 flex translate-y-[150%] items-center justify-between gap-x-4 rounded-full bg-white px-4 py-2 navbar-small:translate-y-1/2 md:right-0 lg:translate-y-full"
        x-cloak x-trap.inert.noscroll.noautofocus="seachModalOpen" x-show="seachModalOpen"
        onsubmit="event.preventDefault();">

        @csrf


        <input class="placeholder:text-cedea-red-500" type="text" placeholder="Cari di sini">

        <button class="" type="button">
            <x-icon.magnifying-glass class="text-cedea-red-500" />
        </button>

    </form>

</div>

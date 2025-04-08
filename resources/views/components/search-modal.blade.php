<div class="grid content-center items-center sm:relative" x-data="{ seachModalOpen: false }" @keydown.escape="seachModalOpen=false"
    @click.outside="seachModalOpen=false">

    <button
        class="origin-bottom-left text-xl transition-all disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50"
        :class="{
            'size-0 translate-y-full': seachModalOpen,
            'size-5 translate-y-0': !seachModalOpen
        }"
        :disabled="seachModalOpen" type="button" @click="seachModalOpen=true">
        <x-icon.magnifying-glass class="size-auto" />
    </button>

    <form
        class="has-[:active]:border-cedea-red-500/5has-[:focus]:border-cedea-red-500/50 absolute right-4 top-full z-10 flex min-h-8 max-w-[90dvw] translate-y-[150%] items-center justify-between gap-x-4 rounded-full border bg-white px-4 py-2 outline-cedea-red-500 has-[:focus]:border-cedea-red-500/50 navbar-small:translate-y-1/2 md:right-0 md:min-w-28 lg:translate-y-full"
        x-cloak x-trap.inert.noscroll="seachModalOpen" x-show="seachModalOpen"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" action="{{ route('search') }}"
        method="GET" @keyup.enter="$event.target.submit(); seachModalOpen=false">

        <input class="p-0.5 text-cedea-red-500 outline-none placeholder:text-cedea-red-500/50 max-sm:w-full"
            id="query" name="query" type="text" placeholder="{{ __('search.placeholder') }}">

        <button type="submit">
            <x-icon.magnifying-glass class="text-cedea-red-500" />
        </button>
    </form>

</div>

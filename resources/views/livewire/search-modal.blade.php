<div x-data="{ fullscreenModal: false }" @keydown.escape="fullscreenModal=false">
    <button
        class="size-full text-xl opacity-60 disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50"
        @production disabled @endproduction type="button" @click="fullscreenModal=true">
        <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36.42 36.41">
            <g>
                <path class="fill-current"
                    d="m15.67.07c1,.09,1.97.29,2.92.59,2.65.84,4.88,2.33,6.67,4.46,2.03,2.43,3.13,5.24,3.32,8.39.06.98.01,1.96-.14,2.93-.36,2.34-1.25,4.47-2.66,6.37q-.22.3.04.56c3.33,3.33,6.66,6.66,9.99,9.99.05.05.1.09.14.14.4.45.55.98.42,1.56-.19.85-1,1.42-1.86,1.32-.43-.05-.77-.24-1.08-.54-2.11-2.12-4.23-4.23-6.35-6.35-1.27-1.27-2.54-2.54-3.81-3.81-.15-.15-.15-.16-.32-.03-2.48,1.87-5.27,2.84-8.37,2.93-.94.03-1.87-.05-2.79-.22-3.23-.6-5.96-2.1-8.15-4.55C1.28,21.17.09,18.04,0,14.5c-.02-.9.05-1.79.22-2.68.6-3.26,2.12-6.02,4.6-8.21C7.51,1.22,10.69.04,14.28,0c.46,0,.93.02,1.39.07ZM3.44,14.29c0,6.04,4.89,10.87,10.86,10.87,5.94,0,10.86-4.78,10.86-10.87,0-6.17-5.04-10.88-10.85-10.85-5.88-.04-10.87,4.75-10.87,10.85Z" />
            </g>
        </svg>
    </button>

    <template x-teleport="body">
        <div class="fixed inset-0 z-[99] flex h-screen w-screen bg-white"
            x-trap.inert.noscroll.noautofocus="fullscreenModal" x-show="fullscreenModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-y-full opacity-50" x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="-translate-y-full opacity-50">
            <button
                class="absolute right-0 top-0 z-30 mr-3 mt-3 flex items-center justify-center space-x-1 rounded-md border border-neutral-200 px-3 py-2 text-xs font-medium uppercase text-neutral-600 hover:bg-neutral-100 lg:border-white/20 lg:bg-black/10 lg:text-white hover:lg:bg-black/30"
                @click="fullscreenModal=false">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span>Close</span>
            </button>

            <div class="relative flex h-full w-full flex-wrap items-center px-8">

                <div class="relative mx-auto w-full max-w-sm lg:mb-0">
                    <div class="relative text-center">

                        <div class="mb-6 flex flex-col space-y-2">
                            <h1 class="text-2xl font-semibold tracking-tight">Cari di sini</h1>
                        </div>
                        <form class="space-y-2" onsubmit="event.preventDefault();">
                            <input class="" type="text" placeholder="krakatoa">

                            <button class="" type="button">
                                Search
                            </button>

                        </form>
                    </div>
                </div>
            </div>


        </div>

    </template>
</div>

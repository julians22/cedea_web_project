{{--
This component is a simplified modal component designed to be used with
video-list livewire element since we can't use the native `<dialog>`
element with Livewire.

This component takes a single slot, which is the content of the modal.
When the modal is open, it will be rendered at the root of the document,
and the background will be made opaque. When the user clicks outside of
the modal, it will be closed. This component also has a close button that
can be clicked to close the modal.
--}}

@teleport('body')
    <div class="${modalOpen ? 'relative w-auto' : '' } h-auto" @keydown.escape.window="modalOpen = false">
        <div class="fixed left-0 top-0 z-[99] flex h-dvh w-screen items-center justify-center" x-show="modalOpen" x-cloak>
            <div class="absolute inset-0 h-full w-full bg-black bg-opacity-40" x-show="modalOpen"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="modalOpen=false">
            </div>

            <div class="relative" x-show="modalOpen" x-trap.inert.noscroll.noautofocus="modalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                <button
                    class="absolute -right-8 -top-8 z-1 mr-5 mt-5 flex items-center justify-center rounded-full bg-gray-50 text-gray-800 hover:bg-white"
                    @click="modalOpen=false" wire:click="handleChangeActiveVideo()">

                    <svg class="size-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="0.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div
                    class="max-h-[90dvh] w-[90vw] min-w-[50vw] overflow-auto rounded-md bg-cedea-red ~p-2/4 sm:max-w-lg sm:rounded-lg lg:max-w-7xl">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
@endteleport

{{--
This component is a simplified modal component designed to be used with
product-list livewire element since we can't use the native `<dialog>`
element with Livewire.

This component takes a single slot, which is the content of the modal.
When the modal is open, it will be rendered at the root of the document,
and the background will be made opaque. When the user clicks outside of
the modal, it will be closed. This component also has a close button that
can be clicked to close the modal.
--}}

@teleport('body')
    <div class="${modalOpen ? 'relative w-auto' : '' } h-auto" @keydown.escape.window="modalOpen = false">
        <div class="h-dvh fixed left-0 top-0 z-[99] flex w-screen items-center justify-center" x-show="modalOpen" x-cloak>
            <div class="absolute inset-0 h-full w-full bg-black bg-opacity-40" x-show="modalOpen"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="modalOpen=false">
            </div>

            <div class="relative max-h-[90dvh] w-[80vw] min-w-[50vw] overflow-auto rounded-lg bg-cedea-red ~p-6/12 sm:max-w-lg sm:rounded-3xl lg:max-w-7xl"
                x-show="modalOpen" x-trap.inert.noscroll.noautofocus="modalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                {{ $slot }}
            </div>
        </div>
    </div>
@endteleport

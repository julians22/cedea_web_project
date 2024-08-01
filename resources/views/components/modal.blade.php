{{--
use alpine,
to change open state use modalOpen
example @click="modalOpen=false"
--}}

@props(['trigger' => null, 'content' => null])

<div class="${modalOpen ? 'relative w-auto' : '' } h-auto" x-data="{ modalOpen: false }"
    @keydown.escape.window="modalOpen = false">

    {{ $slot }}

    @if ($trigger)
        {{ $trigger }}
    @else
        <button
            {{ $attributes->twMergeFor(
                'trigger',
                'inline-flex h-10 items-center justify-center rounded-md border bg-white px-4 py-2 text-sm font-medium transition-colors hover:bg-neutral-100 focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 active:bg-white disabled:pointer-events-none disabled:opacity-50',
            ) }}
            @click="modalOpen=true">Open</button>
    @endif

    <template x-teleport="body">
        <div class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center" x-show="modalOpen"
            x-cloak>
            <div class="absolute inset-0 h-full w-full bg-black bg-opacity-40" x-show="modalOpen"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="modalOpen=false">
            </div>
            <div {{ $attributes->withoutTwMergeClasses()->twMerge('relative bg-white px-4 py-3 px-7 py-6 sm:max-w-lg rounded-lg bg-cedea-red sm:rounded-3xl') }}
                x-show="modalOpen" x-trap.inert.noscroll.noautofocus="modalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                @if ($content)
                    {{ $content }}
                @else
                    <div class="flex items-center justify-between pb-2">
                        <h3 class="text-lg font-semibold">Modal Title</h3>
                        <button
                            class="absolute right-0 top-0 mr-5 mt-5 flex h-8 w-8 items-center justify-center rounded-full text-gray-600 hover:bg-gray-50 hover:text-gray-800"
                            @click="modalOpen=false">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="relative w-auto">
                        <p>This is placeholder text. Replace it with your own content.</p>
                    </div>
                @endif
            </div>
        </div>
    </template>
</div>

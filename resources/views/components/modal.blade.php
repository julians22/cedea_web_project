{{--
use alpine,
to change open state use modalOpen
example @click="modalOpen=false"
--}}

@props(['trigger' => null, 'content' => null])

{{-- TODO: Refactor to dialog element ?  --}}
<div x-data="{ modalOpen: false }">
    @if ($trigger)
        {{ $trigger }}
    @else
        <button
            {{ $attributes->twMergeFor(
                'trigger',
                'inline-flex h-10 items-center justify-center rounded-md border bg-white px-4 py-2 text-sm font-medium transition-colors hover:bg-neutral-100 focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 active:bg-white disabled:pointer-events-none disabled:opacity-50',
            ) }}
            @click="modalOpen = !modalOpen">Open</button>
    @endif

    <dialog
        {{ $attributes->withoutTwMergeClasses()->twMerge('overflow-clip sm:max-w-lg rounded-lg sm:rounded-3xl h-full bg-cedea-red px-4 py-4 sm:px-7 sm:py-6 ') }}
        x-show="modalOpen" x-htmldialog.noscroll="modalOpen = false">
        <div class="h-[95%] overflow-clip">
            <button
                class="absolute right-0 top-0 z-1 flex h-8 w-8 items-center justify-center rounded-full text-white ~mt-2/5 ~mr-2/5 hover:bg-gray-50 hover:text-gray-800"
                type="button" @click="modalOpen=false">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="mt-6 h-full overflow-auto md:mt-8">
                @if ($content)
                    {{ $content }}
                @else
                    <div class="flex items-center justify-between pb-2">
                        <h3 class="text-lg font-semibold">Modal Title</h3>
                    </div>
                    <div class="relative w-auto">
                        <p>This is placeholder text. Replace it with your own content.</p>
                    </div>
                @endif
            </div>
        </div>
    </dialog>
</div>

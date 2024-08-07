@props(['background' => null, 'icon' => null, 'label' => null, 'selected' => true])

<div
    {{ $attributes->withoutTwMergeClasses()->twMerge(
            'group relative left-0 aspect-[2/3.5] overflow-hidden shadow-top transition duration-700 ~rounded-xl/3xl after:absolute after:bottom-0 after:h-full after:w-full after:bg-gradient-to-t after:from-black after:to-60% hover:scale-105 hover:shadow-top-hover',
            !$selected ? 'opacity-35' : '',
        ) }}>
    <img class="z-1 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
        src="{{ $background }}" alt="">
    <div
        class="absolute bottom-0 left-1/2 z-1 grid -translate-x-1/2 grid-cols-1 grid-rows-2 flex-col content-center items-start justify-center justify-items-center gap-4 text-center text-white">
        <img class="~size-14/32" src="{{ $icon }}" alt="">
        <p class="uppercase ~text-xl/4xl ~leading-5/10">
            {{ $label }}
        </p>
    </div>
</div>

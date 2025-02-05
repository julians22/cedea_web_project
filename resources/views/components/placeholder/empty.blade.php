@props(['text' => ''])

<div
    {{ $attributes->withoutTwMergeClasses()->twMerge('col-span-full flex flex-col items-center justify-center self-center justify-self-center') }}>
    <lord-icon {{ $attributes->twMergeFor('icon', 'inline-blsock ~size-20/40') }}
        src="https://cdn.lordicon.com/rmkpgtpt.json" trigger="in" delay="500" state="in-reveal"
        colors="primary:#e4e4e4,secondary:#e4e4e4">
    </lord-icon>

    <h2 {{ $attributes->twMergeFor('text', 'section-title') }}>
        {{ $text }}
    </h2>
</div>

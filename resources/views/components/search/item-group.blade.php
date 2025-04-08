@props([
    'title' => null,
    'showReadmore' => false,
    'readmoreRoute' => null,
])

{{-- Recipe --}}
<div {{ $attributes->withoutTwMergeClasses()->twMerge('my-8 mb-16') }}>
    <h2 class="section-title mb-4 text-left text-cedea-red-dark">{{ $title }}</h2>
    <ul {{ $attributes->twMergeFor('content', 'flex flex-col gap-y-4') }}>
        {{ $slot }}

        @if ($showReadmore)
            <li class="text-right">
                <a href="{{ $readmoreRoute }}">More results</a>
            </li>
        @endif
    </ul>
</div>

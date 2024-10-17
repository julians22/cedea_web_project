@props([
    'title' => null,
    'showReadmore' => false,
    'readmoreRoute' => null,
])

{{-- Recipe --}}
<div class="my-8 mb-16">
    <h1 class="mb-4 text-left font-androgyne text-cedea-red-dark ~text-xl/5xl">{{ $title }}</h1>
    <ul class="flex flex-col gap-y-4">

        {{ $slot }}

        @if ($showReadmore)
            <li class="text-right">
                <a href="{{ $readmoreRoute }}">More results</a>
            </li>
        @endif
    </ul>
</div>

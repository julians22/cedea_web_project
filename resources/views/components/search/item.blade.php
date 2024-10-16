@props([
    'imageurl' => null,
    'alt' => null,
    'title' => null,
    'desc' => null,
    'url' => null,
])

<div class="flex gap-x-8 gap-y-4">
    <div class="aspect-video h-24 overflow-hidden rounded-lg">
        <img src="{{ $imageurl }}" alt="{{ $alt }}">
    </div>

    <div>

        <h3 class="text-lg text-cedea-red-500">
            <a href="{{ $url }}">{{ $title }}</a>
        </h3>

        <p>
            {!! $desc !!}
        </p>
    </div>
</div>

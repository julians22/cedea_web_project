@props([
    'imageurl' => null,
    'alt' => null,
    'title' => null,
    'desc' => null,
    'url' => null,
])

<div {{ $attributes->withoutTwMergeClasses()->twMerge('flex gap-x-8 gap-y-4 max-md:flex-col') }}>
    <a class="aspect-video overflow-hidden rounded-lg max-md:w-full md:h-28" href="{{ $url }}">
        <img {{ $attributes->twMergeFor('image', 'max-md:w-full') }} src="{{ $imageurl }}" alt="{{ $alt }}">
    </a>

    <div>

        <a href="{{ $url }}">
            <h3 class="text-lg text-cedea-red-500">
                {!! $title !!}
            </h3>
        </a>

        <div>
            {!! $desc !!}
        </div>
    </div>
</div>

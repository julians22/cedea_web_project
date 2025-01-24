@props(['video'])
<div class="flex flex-col gap-4">
    <a href="{{ $video->video['url'] }}" target="_blank">
        <img class="aspect-video w-full max-w-none rounded object-cover object-center" src="{{ $video->thumbnail }}"
            alt="{{ $video->title }}">
    </a>
    <p>{{ $video->description }}</p>
</div>

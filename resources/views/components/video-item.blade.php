@props(['video'])
<div class="flex flex-col gap-4" wire:key='{{ $video->id }}-{{ $video->slug }}'>
    <a href="{{ $video->video['url'] }}" target="_blank">
        <img class="aspect-video w-full max-w-none rounded object-cover object-center" src="{{ $video->thumbnail }}"
            alt="{{ $video->title }}">
    </a>
    <h3>{{ $video->title }}</h3>
</div>

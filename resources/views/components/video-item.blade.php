@props(['video', 'listName' => 'Videos'])
<div class="flex cursor-pointer flex-col gap-4" data-video-item data-video-id="{{ $video->slug }}"
    data-video-title="{{ strip_tags((string) $video->title) }}" data-video-type="{{ $video->type }}"
    data-video-list-id="{{ $video->type }}_videos" data-video-list-name="{{ $listName }}"
    @click="()=>{
    modalOpen=true;
    trackVideoSelection($el.dataset);
    $wire.handleChangeActiveVideo(@js($video->slug));
    }"
    wire:key='{{ $video->id }}-{{ $video->slug }}'>
    <div>
        <img class="aspect-video w-full max-w-none rounded object-cover object-center" src="{{ $video->thumbnail }}"
            alt="{{ $video->title }}">
    </div>
    <h3>{{ $video->title }}</h3>
</div>

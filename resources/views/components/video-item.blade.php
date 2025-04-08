@props(['video'])
<div class="flex cursor-pointer flex-col gap-4"
    @click="()=>{
    modalOpen=true;
    $wire.handleChangeActiveVideo('{{ $video->slug }}');
    }"
    wire:key='{{ $video->id }}-{{ $video->slug }}'>
    <div>
        <img class="aspect-video w-full max-w-none rounded object-cover object-center" src="{{ $video->thumbnail }}"
            alt="{{ $video->title }}">
    </div>
    <h3>{{ $video->title }}</h3>
</div>

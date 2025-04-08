@props(['item'])

@php
    $url = $item->link
        ? (Str::startsWith($item->link, ['http://', 'https://'])
            ? $item->link
            : 'https://' . $item->link)
        : null;
@endphp

@if ($url)
    <a href="{{ $url }}" target="_blank">
@endif
<picture>
    <source class="block w-full" srcset="{{ $item->getFirstMediaUrl('banner_desktop') }}" media="(min-width: 1024px)" />
    <img class="mx-auto block h-full w-full object-cover" src="{{ $item->getFirstMediaUrl('banner_mobile') }}"
        alt="{{ $item->title ? $item->title : $item->getFirstMedia('banner_mobile')->name }}" />
</picture>
@if ($url)
    </a>
@endif

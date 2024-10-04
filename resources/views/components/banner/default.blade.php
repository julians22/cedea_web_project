@props(['item'])

<picture>
    <source class="block w-full" srcset="{{ $item->getFirstMediaUrl('banner_desktop') }}" media="(min-width: 1024px)" />
    <img class="mx-auto block h-full w-full object-cover" src="{{ $item->getFirstMediaUrl('banner_mobile') }}"
        alt="{{ $item->getFirstMedia('banner_mobile')->name }}" />
</picture>

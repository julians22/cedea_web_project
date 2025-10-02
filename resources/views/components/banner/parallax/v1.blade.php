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

<div class="atropos my-atropos">
    <!-- scale container (required) -->
    <div class="atropos-scale">
        <!-- rotate container (required) -->
        <div class="atropos-rotate">
            <!-- inner container (required) -->
            <div class="atropos-inner">
                <div class="grid grid-cols-2">
                    <img class="mx-auto block h-full w-full object-cover"
                        src="{{ $item->getFirstMediaUrl('banner_desktop') }}"
                        alt="{{ $item->title ? $item->title : $item->getFirstMedia('banner_desktop')->name }}" />
                    <img class="mx-auto block h-full w-full object-cover"
                        src="{{ $item->getFirstMediaUrl('banner_mobile') }}"
                        alt="{{ $item->title ? $item->title : $item->getFirstMedia('banner_mobile')->name }}" />
                </div>
            </div>
        </div>
    </div>
</div>
@if ($url)
    </a>
@endif

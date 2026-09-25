@props([
    'name',
    'logo',
    'url' => null,
    'type' => 'online',
    'position',
    'class' => '',
    'alt' => null,
])

@php
    $marketplaceUrl = trim((string) ($url ?? ''));
    $hasMarketplaceUrl = $marketplaceUrl !== '' && ! str_starts_with($marketplaceUrl, '#');
    $marketplaceLinkUrl = $hasMarketplaceUrl ? $marketplaceUrl : '';
    $baseClasses = $type === 'offline'
        ? 'inline-grid h-20 max-w-40 flex-initial content-center justify-center text-center'
        : 'flex items-center justify-center ~size-32/36';
    $wrapperClasses = TailwindMerge\Laravel\Facades\TailwindMerge::merge($baseClasses, $class);
    $altText = $alt ?? ($type === 'offline'
        ? "Logo {$name} retail partner CEDEA Seafood"
        : "Logo {$name} marketplace CEDEA Seafood");
@endphp

@if ($hasMarketplaceUrl)
    <a class="{{ $wrapperClasses }}" target="_blank" href="{{ $marketplaceLinkUrl }}" rel="noopener noreferrer">
@else
    <div class="{{ $wrapperClasses }}">
@endif
    <img class="cursor-pointer" data-marketplace-logo
        data-marketplace-name="{{ $name }}"
        data-marketplace-type="{{ $type }}"
        data-marketplace-position="{{ $position }}"
        data-marketplace-url="{{ $marketplaceLinkUrl }}"
        src="{{ $logo }}"
        alt="{{ $altText }}">
@if ($hasMarketplaceUrl)
    </a>
@else
    </div>
@endif

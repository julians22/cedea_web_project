@props([
    'brand',
    'active' => false,
])

<div class="{{ $active ? 'lg:scale-110 border shadow-md' : 'shadow-lg' }} flex cursor-pointer items-center justify-center border-cedea-red bg-white transition duration-700 ~rounded-lg/2xl ~border-4/2 ~p-2/5"
    type="button" wire:key="brand-logo-{{ $brand->id }}"
    wire:click="handleChangeActiveBrand('{{ $brand->slug }}')">
    <img class="line-clamp-4 w-full object-contain text-center text-xs leading-tight"
        src="{{ $brand->getFirstMediaUrl('logo') }}" alt="{{ $brand->desc }} logo">
</div>

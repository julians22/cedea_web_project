@props([
    'brand',
    'activeBrand' => null,
])

<div class="cursor-pointer" wire:key="brand-filter-{{ $brand->id }}">
    <p wire:click="handleChangeActiveBrand('{{ $brand->slug }}')"
        @class([
            '~text-lg/2xl',
            'text-cedea-red-dark' => $brand->slug == $activeBrand,
        ])>
        {{ $brand->name }}</p>
    <div @class([
        'flex flex-col gap-1 overflow-auto transition-all duration-1000',
        'max-h-40 mt-2' => $brand->slug == $activeBrand,
        'max-h-0' => $brand->slug != $activeBrand,
    ])>
        <label for="{{ $brand->slug }}-all">
            <input class="peer hidden" id="{{ $brand->slug }}-all" type="radio"
                value="all" wire:loading.attr="disabled" wire:model.live="activeCategory">
            <div wire:loading.class='cursor-wait' @class([
                'cursor-pointer ~text-sm/base transition-all select-none',
                'peer-checked:text-cedea-red-dark peer-checked:border-l-4 peer-checked:border-cedea-red-dark peer-checked:pl-2 peer-checked:font-bold',
                'hover:border-l-4 hover:pl-2 border-black border-opacity-0 hover:border-opacity-100',
            ])>
                {{ __('All') }}
            </div>
        </label>

        @foreach ($brand->uniqueCategories as $category)
            <label wire:key="brand-filter-{{ $brand->id }}-category-{{ $category->id }}"
                for="{{ $brand->slug }}-{{ $category->slug }}">
                <input class="peer hidden" id="{{ $brand->slug }}-{{ $category->slug }}"
                    type="radio" value="{{ $category->slug }}" wire:loading.attr="disabled"
                    wire:model.live="activeCategory">
                <div wire:loading.class='cursor-wait' @class([
                    'cursor-pointer ~text-sm/base transition-all select-none',
                    'peer-checked:text-cedea-red-dark peer-checked:border-l-4 peer-checked:border-cedea-red-dark peer-checked:pl-2 peer-checked:font-bold',
                    'hover:border-l-4 hover:pl-2 border-black border-opacity-0 hover:border-opacity-100',
                ])>
                    {{ $category->name }}
                </div>
            </label>
        @endforeach
    </div>
</div>

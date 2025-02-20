{{-- ? should we just get the recipe model as props ? --}}
@props([
    'product' => null,
    'name' => null,
    'slug' => '#',
    'imagePath' => null,
    'description' => null,
    'category' => null,
])

<div class="grid grid-cols-1 gap-4 md:grid-cols-2" wire:key="{{ $slug }}">
    <a class="text-cedea-red ~text-lg/2xl" href="{{ route('recipe.show', $slug) }}">
        <img class="aspect-video overflow-hidden rounded-3xl object-cover object-center" src="{{ $imagePath }}"
            alt="{{ $name }} thumbnail">
    </a>

    <div>
        <div class="w-fit rounded-full border-2 border-cedea-red px-2 text-cedea-red">
            {{ Str::title($category) }}</div>
        @if ($product)
            <p class="mt-1 uppercase text-cedea-red ~text-sm/base">{{ $product->name }}</p>
        @endif
        <a class="text-cedea-red ~text-lg/2xl" href="{{ route('recipe.show', $slug) }}">{{ $name }}</a>
        <div class="mt-2 text-ellipsis md:line-clamp-4 lg:line-clamp-6">{{ $description }}</div>
    </div>
</div>

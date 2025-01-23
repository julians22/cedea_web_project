@props([
    'product' => null,
    'name' => null,
    'slug' => '#',
    'imagePath' => null,
    'description' => null,
])

<div class="grid grid-cols-1 gap-4 md:grid-cols-2" wire:key="{{ slug }}">
    <a class="text-cedea-red ~text-lg/2xl" href="{{ route('recipe.detail', $slug) }}">
        <img class="aspect-video overflow-hidden rounded-3xl object-cover object-center" src="{{ $imagePath }}"
            alt="{{ $name }} thumbnail">
    </a>

    <div>
        @if ($product)
            <p class="uppercase text-cedea-red ~text-sm/base">{{ $product->name }}</p>
        @endif
        <a class="text-cedea-red ~text-lg/2xl" href="{{ route('recipe.detail', $slug) }}">{{ $name }}</a>
        <div class="mt-2 text-ellipsis md:line-clamp-4 lg:line-clamp-6">{{ $description }}</div>
    </div>
</div>

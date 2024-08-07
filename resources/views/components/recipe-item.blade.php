@props([
    'product' => null,
    'name' => null,
    'imagePath' => null,
    'description' => null,
])

<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    <img class="aspect-video overflow-hidden rounded-3xl object-cover object-center" src="{{ $imagePath }}"
        alt="">

    <div>
        <p class="uppercase text-cedea-red ~text-sm/base">{{ $product }}</p>
        <h2 class="text-cedea-red ~text-lg/2xl">{{ $name }}</h2>
        <div class="mt-2 text-ellipsis md:line-clamp-4 lg:line-clamp-6">{{ $description }}</div>
    </div>
</div>

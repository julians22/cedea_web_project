@props([
    'item',
    'index',
])

<li class="group/product relative z-0 flex flex-col gap-8 hover:z-20" data-product-item
    data-item-id="{{ $item->slug }}" data-item-name="{{ $item->fullname }}"
    data-item-brand="{{ $item->brand->name }}"
    data-item-category="{{ $item->categories->first()?->name }}"
    data-item-index="{{ $index }}" wire:key="product-card-{{ $item->id }}">
    <div
        class="group/image flex h-full flex-col justify-between drop-shadow-xl transition hover:drop-shadow-lg">
        <div
            class="aspect-square transition-transform duration-500 ease-in-out group-hover/image:-rotate-6 group-hover/image:scale-105">
            <img class="size-ful aspect-square cursor-pointer object-contain object-center"
                data-product-modal-trigger
                src="{{ $item->getFirstMediaUrl('packaging', 'preview_cropped') }}"
                alt="{{ $item->fullname }} - produk {{ $item->brand->name }}">
        </div>

    </div>
    <div class="pointer-events-none absolute top-full isolate z-10 hidden h-auto w-full cursor-pointer items-center opacity-0 drop-shadow-top transition duration-200 before:absolute before:left-1/2 before:-z-1 before:size-8 before:-translate-x-1/2 before:-translate-y-1/2 before:rotate-45 before:rounded-tl-lg before:bg-white before:duration-700 group-hover/product:pointer-events-auto group-hover/product:opacity-100 lg:block"
        data-product-modal-trigger>
        <div
            class="flex items-center justify-between gap-2 rounded-xl bg-gradient-to-r from-[#ededed] via-white to-[#ededed] ~px-3/4 ~py-2/3 max-md:flex-col">

            <img class="w-16" src="{{ $item->brand->getFirstMediaUrl('logo') }}"
                alt="Logo {{ $item->brand->name }}">

            <div class="text-pretty text-cedea-red-dark">
                {{ $item->fullname }}
            </div>

            <div class="cursor-pointer text-cedea-red max-md:hidden">
                <svg class="h-5" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 17.78 32.83">
                    <g>
                        <g style="fill: none; filter: url(#d);">
                            <polyline class="fill-none stroke-cedea-red"
                                points="1.36 .75 16.72 16.11 .75 32.07"
                                style="fill: none; stroke-linecap: round; stroke-miterlimit: 10; stroke-width: 2px;" />
                        </g>
                    </g>
                </svg>
            </div>

        </div>
    </div>
</li>

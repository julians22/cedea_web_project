<div class="space-y-8 bg-brick ~py-20/40" x-data="{ activeProduct: $wire.entangle('activeProduct') }">
    <section class="container">
        <div class="grid grid-cols-1 items-center justify-center ~mb-4/10 ~gap-4/8 md:grid-cols-[auto_1fr]">
            <h1 class="section-title m-0">Kreasi Resep <span class="font-montserrat font-semibold">Cedea</span></h1>
            <div class="relative ~pr-0/20">
                <x-lucide-search class="size-6 absolute left-2 top-1/2 -translate-y-1/2 md:left-3" />
                <input
                    class="block w-full rounded-full border border-black bg-transparent px-1 py-3 ps-10 text-sm placeholder:text-black"
                    id="recipe-search" wire:model.live='keyword' type="search"
                    placeholder="CARI RESEP MENARIK DI SINI" />
            </div>
        </div>

        <p>
            Menghadirkan kesegaran laut dalam setiap gigitan. Jelajahi kekayaan laut dengan rangkaian produk terbaik
            dari Cedea Seafood! Mulai dari sarapan pagi hingga malam, temukan tips-tips kuliner yang memikat di setiap
            sajian.
        </p>

        @php
            $times = [
                [
                    'label' => 'Sarapan',
                    'icon' => asset('img/icons/time/sarapan.svg'),
                    'background' => asset('img/time/sarapan.jpg'),
                    'recipe_type' => 'sarapan',
                ],
                [
                    'label' => 'Makan Siang',
                    'icon' => asset('img/icons/time/makan_siang.svg'),
                    'background' => asset('img/time/makan_siang.jpg'),
                    'recipe_type' => 'makan-siang',
                ],
                [
                    'label' => 'Makan Malam',
                    'icon' => asset('img/icons/time/makan_malam.svg'),
                    'background' => asset('img/time/makan_malam.jpg'),
                    'recipe_type' => 'makan-malam',
                ],
                [
                    'label' => 'Snack',
                    'icon' => asset('img/icons/time/snack.svg'),
                    'background' => asset('img/time/snack.jpg'),
                    'recipe_type' => 'snack',
                ],
            ];
        @endphp

        <x-meals-container>
            @foreach ($times as $time)
                <div wire:click="handleChangeActiveRecipeType('{{ $time['recipe_type'] }}')">
                    <x-meal-card class="cursor-pointer" :background="$time['background']" :icon="$time['icon']" :label="$time['label']"
                        :selected="$time['recipe_type'] === $activeRecipeType || $activeRecipeType == null" />
                </div>
            @endforeach
        </x-meals-container>
    </section>

    <section class="container flex flex-col ~gap-8/16 ~px-4/60">
        @php
            $recipes = [
                [
                    'product' => 'Cedea Salmon fish cake',
                    'name' => 'Lorem Ipsum',
                    'imagePath' => asset('placeholder/recipe-1.jpg'),
                    'description' =>
                        'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut',
                ],
                [
                    'product' => 'Cedea Salmon fish cake',
                    'name' => 'Lorem Ipsum',
                    'imagePath' => asset('placeholder/recipe-2.jpg'),
                    'description' =>
                        'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut',
                ],
            ];
        @endphp
        @foreach ($recipes as $recipe)
            <x-recipe-item :name="$recipe['name']" :product="$recipe['product']" :imagePath="$recipe['imagePath']" :description="$recipe['description']" />
        @endforeach
    </section>

    <section class="container relative overflow-visible font-medium" wire:ignore x-data="{ lengthFromLeft: 0 }"
        x-resize.document="lengthFromLeft = $el.getBoundingClientRect().left">
        <h2 class="section-title">
            Intip Resep Dengan Produk ini Yuk
        </h2>

        <div :style="`margin-right: calc(-${lengthFromLeft}px - 1rem)`">
            <x-recipe-list-product-slider />
        </div>
    </section>
</div>

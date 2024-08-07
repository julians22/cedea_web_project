<div class="space-y-8 ~py-20/40">
    <section class="container">
        <div class="grid grid-cols-1 items-center justify-center ~mb-4/10 ~gap-4/8 md:grid-cols-[auto_1fr]">
            <h1 class="section-title m-0">Kreasi Resep <span class="font-montserrat font-semibold">Cedea</span></h1>
            <div class="relative">
                <x-lucide-search class="size-6 absolute left-2 top-1/2 -translate-y-1/2 md:left-8" />
                <input
                    class="block w-full rounded-full border border-black px-1 py-3 ps-10 text-sm placeholder:text-black md:ml-6"
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
                    'selected' => true,
                ],
                [
                    'label' => 'Makan Siang',
                    'icon' => asset('img/icons/time/makan_siang.svg'),
                    'background' => asset('img/time/makan_siang.jpg'),
                    'selected' => false,
                ],
                [
                    'label' => 'Makan Malam',
                    'icon' => asset('img/icons/time/makan_malam.svg'),
                    'background' => asset('img/time/makan_malam.jpg'),
                    'selected' => false,
                ],
                [
                    'label' => 'Snack',
                    'icon' => asset('img/icons/time/snack.svg'),
                    'background' => asset('img/time/snack.jpg'),
                    'selected' => false,
                ],
            ];
        @endphp

        <x-meals-container>
            @foreach ($times as $time)
                <div>
                    <x-meal-card class="cursor-pointer" :background="$time['background']" :icon="$time['icon']" :label="$time['label']"
                        :selected="$time['selected']" />
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

    <section class="container">
        <h2 class="section-title">
            Intip Resep Dengan Produk ini Yuk
        </h2>

        <x-recipe-list-product-slider />
    </section>
</div>

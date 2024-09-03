<x-layouts.app>

    <x-video-player url="{{ asset('video/product.mp4') }}" />

    <div class="bg-brick">
        <section class="container my-8 grid gap-x-4 gap-y-8 md:grid-cols-[30%_1fr]">
            <div class="flex w-full flex-col items-center gap-y-4">
                <img src="{{ asset('placeholder/product.png') }}" alt="">

                <a class="w-max rounded-full bg-cedea-red-400 px-8 py-2 uppercase text-white ~text-sm/base"
                    href="#">Beli sekarang</a>

            </div>
            <div class="flex flex-col gap-y-8">
                <div class="flex flex-col gap-2">
                    <p class="uppercase ~text-base/2xl">cedea salmon sosis keju</p>
                    <h1 class="~text-2xl/5xl">Sosis Kentang Korea</h1>
                </div>
                <div class="prose">
                    <p>Bahan Utama:</p>
                    <ul>
                        <li>6 buah CEDEA Salmon Sosis Keju, potong iris-iris</li>
                        <li>2 buah Kentang, potong dadu, goreng, sisihkan</li>
                        <li>3 siung Bawang putih, cincang</li>
                        <li>1/2 buah Bawang bombay, iris memanjang</li>
                        <li>1 btg Daun bawang, rajang</li>
                        <li>Secukupnya Air matang</li>
                    </ul>
                    <p>Cara Membuat:</p>
                    <ol class="list-decimal">
                        <li>Tumis bawang putih hingga harum, masukkan sosis dan bawang bombay, tumis sebentar</li>
                        <li>Masukan bahan saus dan air secukupnya.</li>
                        <li>Masukan kentang goreng dan daun bawang, aduk rata.</li>
                        <li>Angkat dan sajikan.</li>
                    </ol>
                </div>
            </div>
        </section>

        <hr class="container my-8 h-0.5 border-0 bg-gray-200 dark:bg-gray-700">

        {{-- recipe --}}
        <section class="container mt-8" wire:ignore>
            <h2 class="section-title">Kreasi Resep <span class="font-montserrat font-semibold">Cedea</span></h2>

            <p>Menghadirkan kesegaran laut dalam setiap gigitan. Jelajahi kekayaan laut dengan rangkaian produk terbaik
                dari
                Cedea Seafood! Mulai dari
                sarapan pagi hingga malam, temukan tips-tips kuliner yang memikat di setiap sajian.</p>

            <div>
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
                        <a href="{{ route('recipe', ['recipe_type' => $time['recipe_type']]) }}">
                            <x-meal-card class="cursor-pointer" :background="$time['background']" :icon="$time['icon']" :label="$time['label']" />
                        </a>
                    @endforeach
                </x-meals-container>
            </div>
        </section>
    </div>
</x-layouts.app>

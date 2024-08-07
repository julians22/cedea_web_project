<x-layouts.app>
    <x-video-player />

    <livewire:frontend.product-list />

    <section class="container mt-8" wire:ignore>
        <h2 class="section-title">Kreasi Resep <span class="font-montserrat font-semibold">Cedea</span></h2>

        <p>Menghadirkan kesegaran laut dalam setiap gigitan. Jelajahi kekayaan laut dengan rangkaian produk terbaik dari
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
                        'recipe_type' => 'makan_siang',
                    ],
                    [
                        'label' => 'Makan Malam',
                        'icon' => asset('img/icons/time/makan_malam.svg'),
                        'background' => asset('img/time/makan_malam.jpg'),
                        'recipe_type' => 'makan_malam',
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
</x-layouts.app>

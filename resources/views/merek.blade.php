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
                    ],
                    [
                        'label' => 'Makan Siang',
                        'icon' => asset('img/icons/time/makan_siang.svg'),
                        'background' => asset('img/time/makan_siang.jpg'),
                    ],
                    [
                        'label' => 'Makan Malam',
                        'icon' => asset('img/icons/time/makan_malam.svg'),
                        'background' => asset('img/time/makan_malam.jpg'),
                    ],
                    [
                        'label' => 'Snack',
                        'icon' => asset('img/icons/time/snack.svg'),
                        'background' => asset('img/time/snack.jpg'),
                    ],
                ];
            @endphp

            <div class="my-14 grid grid-cols-2 ~gap-4/8 md:grid-cols-4">
                @foreach ($times as $time)
                    <a class="group relative left-0 aspect-[2/3.5] overflow-hidden shadow-top transition duration-700 ~rounded-xl/3xl after:absolute after:bottom-0 after:h-full after:w-full after:bg-gradient-to-t after:from-black after:to-60% hover:scale-105 hover:shadow-top-hover"
                        href="#">
                        <img class="z-1 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
                            src="{{ $time['background'] }}" alt="">
                        <div
                            class="absolute bottom-0 left-1/2 z-1 grid -translate-x-1/2 grid-cols-1 grid-rows-2 flex-col content-center items-start justify-center justify-items-center gap-4 text-center text-white">
                            <img class="~size-14/32" src="{{ $time['icon'] }}" alt="">
                            <p class="uppercase ~text-xl/4xl ~leading-5/10">
                                {{ $time['label'] }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>

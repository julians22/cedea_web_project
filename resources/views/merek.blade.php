<x-layouts.app>

    <section class="aspect-video">
        <img src="{{ asset('img/video-placeholder.jpg') }}" alt="">
        {{-- <video src="" autoplay></video> --}}
    </section>

    <livewire:frontend.products :tags="$tags" :categories="$categories" />

    <section class="container mt-8">
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

            <div class="my-14 grid grid-cols-4 gap-x-8">
                @foreach ($times as $time)
                    <div
                        class="group relative left-0 aspect-[2/3.5] overflow-hidden rounded-3xl shadow-top transition duration-700 after:absolute after:bottom-0 after:h-full after:w-full after:bg-gradient-to-t after:from-black/90 after:to-50% hover:scale-105 hover:shadow-top-hover">
                        <img class="z-1 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
                            src="{{ $time['background'] }}" alt="">
                        <div
                            class="absolute bottom-8 left-1/2 z-1 flex h-2/5 w-2/3 -translate-x-1/2 flex-col items-center justify-between gap-4 text-center text-white">
                            <img class="size-32" src="{{ $time['icon'] }}" alt="">
                            <p class="uppercase ~text-2xl/4xl">{{ $time['label'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>

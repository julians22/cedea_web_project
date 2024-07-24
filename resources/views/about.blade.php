<x-layouts.app>

    {{-- About 1 --}}
    <x-section-banner :imageUrl="asset('img/sosis-salmon.jpg')" title="Pelopor Ikan Olahan Bermutu">

        <x-slot:desc>
            <p>
                PT. CitraDimensi Arthali merupakan salah satu perusahaan di Indonesia yang bergerak di bidang pengolahan
                hasil perikanan dan manufaktur frozen seafood dengan brand CEDEA yang berlokasi di Muara Baru, Jakarta
                Utara.
            </p>
        </x-slot>

    </x-section-banner>

    {{-- About 2 --}}
    <x-section-banner class="from-cedea-red via-cedea-red max-md:bg-cedea-red" class:title="text-white"
        class:desc="text-white" :imageUrl="asset('img/cedea-industrial.jpg')" title="Komitmen Sejak 2004">

        <x-slot:desc>
            <p>
                Berdiri sejak 1995, PT CitraDimensi Arthali juga merupakan pelopor industri makanan olahan berbasis
                hasil laut. kualitas dalam produksi setiap olahannya, dengan menerapkan teknologi produksi yang
                mutakhir, PT CitraDimensi Arthali berhasil menjadi salah satu produsen makanan olahan berbasis hasil
                laut yang dipasarkan di berbagai pasar di Indonesia.
            </p>
        </x-slot>

        <x-slot:button>
            <button class="rounded-full bg-white px-4 py-2 text-cedea-red">
                Lihat Perjalanan Kami
            </button>
        </x-slot>
    </x-section-banner>

    {{-- About 3 --}}
    {{-- Visi Misi --}}
    <section class="grid grid-cols-2 items-center justify-center text-justify text-cedea-red">
        <div
            class="container flex h-80 flex-col items-center justify-center bg-gradient-to-r from-white to-[#E6E7E8] px-32 py-10 pr-0">
            <div class="w-3/5">
                <h2 class="mb-4 text-center font-great-vibes ~text-2xl/5xl">Visi</h2>
                <p class="text-last-center">Menjadi pemain unggul di bisnis makanan siap masak di
                    indonesia dan menjadi
                    pilihan utama di pasar
                    global tertentu.</p>
            </div>
        </div>
        <div
            class="container flex h-80 flex-col items-center justify-center bg-gradient-to-r from-white to-[#E6E7E8] px-32 py-10 pl-0">
            <div class="w-3/5">
                <h2 class="mb-4 text-center font-great-vibes ~text-2xl/5xl">Misi</h2>
                <p class="text-last-center">Aktif berperan dalam menyehatkan bangsa
                    dengan membuat produk makanan bergizi,
                    aman dan bermanfaat untuk seluruh lapisan
                    masyarakat melalui pendekatan inovasi dan
                    teknologi serta perbaikan berkesinambungan.</p>
            </div>
        </div>
    </section>

    {{-- Value section --}}
    <section class="my-10">
        <div class="container">
            @php
                $giat = ['Giat', 'Iman', 'Gesit', 'Inovasi', 'Handal'];
            @endphp

            <h2 class="mb-10 font-great-vibes text-cedea-red ~text-2xl/5xl">Nilai-nilai Perusahaan</h2>

            <div class="container flex justify-center gap-x-12 max-md:flex-col">
                @foreach ($giat as $index => $letter)
                    <div class="before:size-[4.6rem] befor relative flex w-min flex-col items-center justify-center text-center shadow-black drop-shadow-2xl before:absolute before:left-[14.7rem] before:top-[7.2rem] before:rotate-45 before:rounded-lg before:border-8 before:border-white before:bg-cedea-red after:absolute after:left-20 after:top-[6.5rem] after:h-[6.1rem] after:w-48 after:border-y-8 after:border-white after:bg-cedea-red before:[&:last-child]:hidden after:[&:last-child]:hidden"
                        style="z-index: {{ count($giat) - $index }}">
                        <x-lucide-bike
                            class="-z-1 -mb-4 h-28 w-1/2 rounded-t-full border-8 border-white bg-cedea-red px-2 text-white shadow-black drop-shadow-xl" />
                        <div
                            class="gradientto z-1 grid items-center justify-center rounded-xl border-8 border-white bg-gradient-to-br from-cedea-red from-0% via-cedea-red via-50% to-cedea-red-400 to-50% uppercase text-white ~text-6xl/9xl ~h-28/60 ~w-20/52">
                            {{ $letter[0] }}
                        </div>
                        <div class="w-3/5 rounded-b-xl bg-white p-1 text-center capitalize ~text-xl/2xl">
                            {{ $letter }}
                        </div>
                    </div>
                @endforeach
            </div>

            @php
                $value_list = [
                    [
                        'title' => 'Menjadi Pemain Unggul di Indonesia',
                        'content' =>
                            'Kita harus lari lebih cepat mencapai pertumbuhan yang lebih tinggi dan diakui sebagai pemenang dibandingkan dengan pesaing dengan bisnis yang sejenis untuk wilayah Indonesia.',
                    ],
                    [
                        'title' => 'Menjadi Pilihan Utama di Pasar Global Tertentu',
                        'content' => 'Kita harus mampu dan handal untuk menjadi bagian dari pemain global dengan mampu mengeksport produk-produk Cedea
                            melalui strategi pemasaran dan perencanaan yang cermat melalui penetrasi pasar Global tertentu sehingga tercapai target
                            bahwa produk CEDEA menjadi pilihan utama bagi masyarakat di daerah tersebut.',
                    ],
                    [
                        'title' => 'Inovasi dan Teknologi',
                        'content' => 'Kita harus selalu mengikuti perkembangan pasar maupun teknologi, memiliki ide-ide baru untuk perbaikan, pembaharuan produk
                            dan corrective action dalam perbaikan proses yang dijalankan.',
                    ],
                ];
            @endphp

            <div class="container my-10 flex flex-col gap-y-8">
                @foreach ($value_list as $index => $item)
                    <div class="grid grid-cols-[3rem_1fr] gap-x-4">
                        <div
                            class="size-10 flext relative items-center justify-center rounded-full bg-cedea-red p-2 text-white">
                            <p class="text-center text-xl font-semibold">
                                {{ $index + 1 }}</p>
                        </div>
                        <div>
                            <h3 class="mb-4 w-fit rounded-full bg-cedea-red px-4 py-2 text-white">{{ $item['title'] }}
                            </h3>
                            <p class="ml-4">{{ $item['content'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    {{-- Achieve Section --}}
    <section class="bg-left-top bg-repeat py-8 xl:py-10" id="sertifikasi"
        style="background-size: 50%; background-image: url({{ asset('img/pattern-visi-misi.webp') }})">
        <div class="container space-y-8 px-4 lg:px-0">
            <div class="cedea-title text-center text-cedea-red">Mutu yang Tetap Terjaga</div>
            <div class="flex flex-wrap justify-around space-x-0 lg:justify-center lg:space-x-10">
                <div class="max-w-24 lg:max-w-48 w-full">
                    <img class="w-full invert" src="{{ asset('img/achieve-04.png') }}" alt="">
                </div>
                <div class="max-w-24 lg:max-w-48 w-full">
                    <img class="w-full" src="{{ asset('img/achieve-03.png') }}" alt="">
                </div>
                <div class="max-w-24 lg:max-w-48 w-full">
                    <img class="w-full" src="{{ asset('img/achieve-01.png') }}" alt="">
                </div>
                <div class="max-w-24 lg:max-w-48 w-full">
                    <img class="w-full" src="{{ asset('img/achieve-02.png') }}" alt="">
                </div>
            </div>

            <div>
                <p class="text-center">CEDEA SEAFOOD diproduksi oleh PT CitraDimensi Arthali yang berkomitmen untuk
                    terus menghasilkan makanan beku dari ikan olahan terbaik dengan penerapan GMP, HACCP, ISO 22000,
                    BPOM, Halal.</p>
            </div>
        </div>
    </section>


</x-layouts.app>

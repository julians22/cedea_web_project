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
            <x-modal class="bg-cedea-red sm:rounded-2xl">


                <x-slot:trigger>
                    <button class="rounded-full bg-white px-4 py-2 text-cedea-red" type="button" @click="modalOpen=true">
                        Lihat Perjalanan Kami </button>
                </x-slot:trigger>

                <x-slot:content>
                    <div class="flex justify-center text-white">
                        <ul>
                            @for ($i = 0; $i < 4; $i++)
                                <li class="relative flex items-baseline gap-6 pb-5">
                                    <div
                                        class="before:absolute before:left-[5.5px] before:h-full before:w-[1px] before:bg-white">
                                        <svg class="bi bi-circle-fill fill-white" xmlns="http://www.w3.org/2000/svg"
                                            width="12" height="12" viewBox="0 0 16 16">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-great-vibes">Berdiri Sejak</p>
                                        <p class="mt-2 text-sm">Lorem ipsum dolor sit amet,
                                            consectetur
                                            adipisicing elit. Maiores incidunt blanditiis dignissimos, enim earum
                                            mollitia.</p>
                                    </div>
                                </li>
                            @endfor
                        </ul>
                    </div>
                </x-slot:content>
            </x-modal>
            {{-- <button class="rounded-full bg-white px-4 py-2 text-cedea-red">
                Lihat Perjalanan Kami
            </button> --}}
        </x-slot>
    </x-section-banner>

    {{-- About 3 --}}
    {{-- Visi Misi --}}
    <section class="grid grid-cols-1 items-center justify-center text-justify text-cedea-red md:grid-cols-2">
        <div
            class="flex w-full flex-col items-center justify-center bg-gradient-to-r from-white to-[#E6E7E8] py-10 pr-0 ~md:~px-8/32 md:h-80">
            <div class="container md:w-3/5">
                <h2 class="mb-4 text-center font-great-vibes ~text-2xl/5xl">Visi</h2>
                <p class="text-last-center">Menjadi pemain unggul di bisnis makanan siap masak di
                    indonesia dan menjadi
                    pilihan utama di pasar
                    global tertentu.</p>
            </div>
        </div>
        <div
            class="flex w-full flex-col items-center justify-center bg-gradient-to-r from-white to-[#E6E7E8] py-10 pl-0 ~px-16/32 md:h-80">
            <div class="container md:w-3/5">
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
    <section class="my-16">
        <div class="container">
            @php
                $giat = ['Giat', 'Iman', 'Gesit', 'Inovasi', 'Handal'];
            @endphp

            <h2 class="mb-10 font-great-vibes text-cedea-red ~text-2xl/5xl">Nilai-nilai Perusahaan</h2>

            <div class="container flex justify-center gap-x-12 max-md:flex-col">
                @foreach ($giat as $index => $letter)
                    <div class="before:size-[4.6rem] befor relative flex w-min flex-col items-center justify-center text-center shadow-black drop-shadow-2xl before:absolute before:left-[14.7rem] before:top-[6.7rem] before:rotate-45 before:rounded-lg before:border-8 before:border-white before:bg-cedea-red after:absolute after:left-20 after:top-[6rem] after:h-[6.1rem] after:w-48 after:border-y-8 after:border-white after:bg-cedea-red before:[&:last-child]:hidden after:[&:last-child]:hidden"
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
    <section class="container my-16 grid grid-cols-1 gap-x-8 md:grid-cols-2">

        <div>
            <h2 class="mb-10 font-great-vibes text-cedea-red ~text-2xl/5xl">Mutu yang Tetap Terjaga</h2>
            <p class="~text-xs/base">CEDEA SEAFOOD diproduksi oleh PT CitraDimensi Arthali yang
                berkomitmen untuk terus menghasilkan makanan beku dari ikan
                olahan terbaik dengan penerapan GMP, HACCP, ISO 22000, BPOM,
                Halal.</p>
        </div>

        <div class="flex justify-between gap-x-2">
            <div class="~max-w-20/32">
                <img class="invert" src="{{ asset('img/achieve-04.png') }}" alt="">
            </div>

            <div class="~max-w-20/32">
                <img class="" src="{{ asset('img/achieve-03.png') }}" alt="">
            </div>

            <div class="~max-w-20/32">
                <img class="" src="{{ asset('img/achieve-01.png') }}" alt="">
            </div>

            <div class="~max-w-20/32">
                <img class="" src="{{ asset('img/achieve-02.png') }}" alt="">
            </div>
        </div>
    </section>

    {{-- Map --}}
    <section class="container my-16">
        <h2 class="mb-10 font-great-vibes text-cedea-red ~text-2xl/5xl">Wilayah Kerja</h2>
        <div class="mx-auto w-3/4">
            <img src="{{ asset('img/map.svg') }}" alt="">
        </div>

        <div>

            @php
                $addresses = [
                    [
                        'title' => 'PT CitraDimensi Arthali Medan',
                        'content' => 'Jl. KL. Yos Sudarso Km.10,5 Kawasan Industri Medan I (Jl. Pulau Sulawesi)
                        Medan 20242',
                    ],
                    [
                        'title' => 'PT CitraDimensi Arthali Jakarta',
                        'content' => 'Perumahan Prasarana Perikanan Samudera Block N No. 11 - 12,
                        JL Pari Raya, Muara Baru Ujung, Jakarta Utara, DKI Jakarta, 14440',
                    ],
                    [
                        'title' => 'PT CitraDimensi Arthali Majalengka',
                        'content' => 'Jl. Raya Cirebon - Bandung No.Km 35, Sindangwasa, Kec. Palasah,
                        Kabupaten Majalengka, Jawa Barat 45475',
                    ],
                    [
                        'title' => 'PT CitraDimensi Arthali Semarang',
                        'content' =>
                            'Jl. Tambak Aji Raya V No. 9, Tambakaji, Kec. Ngaliyan, Kota Semarang, Jawa Tengah 50185',
                    ],
                ];
            @endphp
            <div class="my-8 grid gap-8 md:grid-cols-2">
                @foreach ($addresses as $address)
                    <div
                        class="grid grid-cols-[0.4rem_1fr] gap-x-4 rounded-2xl bg-gradient-to-r from-[#EDEDED] to-[#CCCCCC] px-2 py-4">
                        <div class="bg-cedea-red"></div>
                        <div>
                            <h3 class="font-bold">{{ $address['title'] }}</h3>
                            <p>{{ $address['content'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>


</x-layouts.app>

<section class="relative bg-cedea-red bg-left-top bg-repeat py-8 bg-blend-multiply xl:py-10"
    style="background-size: 10%; background-image: url({{ asset('img/home-pattern.png') }})">

    <div class="container">
        <h2 class="font-great-vibes text-white ~text-2xl/4xl">
            Artikel Terkini
        </h2>

        <div class="mb-8 mt-2 flex justify-between text-white">
            <div class="flex gap-x-8">
                @foreach ($types as $type)
                    <p wire:click='handleChangeType("{{ $type }}")' @class([
                        'cursor-pointer',
                        'flex flex-col after:h-0.5 after:w-1/2 after:bg-white' =>
                            $type === $currentType,
                    ])>
                        {{ $type }}</p>
                @endforeach
            </div>
            <a class="cursor-pointer rounded-full bg-white px-2 py-1 font-semibold text-cedea-red">
                Semua Berita
            </a>
        </div>

        <div class="grid grid-flow-dense grid-cols-1 ~gap-4/8 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">

            {{-- featured news --}}
            <div
                class="col-span-1 row-span-1 overflow-hidden rounded-xl md:col-span-2 md:row-span-1 lg:row-span-3 2xl:[&:not(:only-child)]:mr-8">
                <img class="w-full object-cover" src="{{ asset('img/featured-news-thumb-demo.jpg') }}" alt="">
                <div class="flex h-full w-full flex-col gap-y-4 bg-white p-4 font-semibold">
                    <p class="text-[#919497]">08 Mei 2024 | Berita</p>
                    <h2 class="line-clamp-3 ~text-lg/2xl">CEDEA Goes to School Edukasi Makan Ikan Jadi Anak Pintar</h2>
                    <a class="w-fit cursor-pointer rounded-xl bg-cedea-yellow-1 px-8 py-1 uppercase text-cedea-red">
                        Baca Beritanya
                    </a>
                </div>
            </div>

            {{-- news list --}}
            {{-- <div class="grid grid-cols-2 gap-4"> --}}
            @for ($i = 0; $i < 6; $i++)
                <div class="flex overflow-hidden rounded-xl">
                    <img class="h-full w-40 object-cover" src="{{ asset('img/news-thumb-demo.jpg') }}" alt="">
                    <div class="flex h-full w-full flex-col justify-center gap-y-4 bg-white p-4 font-semibold">
                        <p class="cursor-pointer text-[#919497] ~text-xs/sm">8 Mei 2024 | Berita</p>
                        <h2 class="line-clamp-3 ~text-sm/base">CEDEA Goes to School Edukasi Makan Ikan Jadi Anak Pintar
                        </h2>
                    </div>
                </div>
            @endfor
            {{-- </div> --}}
        </div>
    </div>
</section>

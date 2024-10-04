<section class="relative bg-left-top bg-repeat bg-blend-multiply ~pt-12/14 ~pb-16/20">

    <div class="container">
        <div class="mx-auto mb-12 text-center md:w-1/2">
            <h2 class="section-title mb-4 text-cedea-red-500">
                Berita <span class="font-montserrat font-semibold">CEDEA</span>
            </h2>
            <p>
                Temukan berita terbaru dan update kegiatan perusahaan kami di sini. Ikuti
                perkembangan terbaru dan berita penting dari Cedea Seafood.
            </p>
        </div>

        <div class="mb-8 mt-2 flex justify-between">
            <div class="flex gap-x-8">
                @foreach ($types as $type)
                    <button type="button" cla wire:click='handleChangeType("{{ $type }}")'
                        @class([
                            'cursor-pointer px-6 py-0.5 border border-cedea-red text-cedea-red rounded-full',
                            'flex flex-col after:h-0.5 bg-cedea-red text-white after:w-1/2 ' =>
                                $type === $currentType,
                        ])>
                        {{ $type }}</button>
                @endforeach
            </div>

            <div class="relative ~pr-0/20">
                <x-lucide-search class="size-6 absolute left-2 top-1/2 -translate-y-1/2 md:left-3" />
                <input
                    class="block w-full rounded-full border border-black bg-transparent px-1 py-3 ps-10 text-sm placeholder:text-black"
                    id="recipe-search" wire:model.live='keyword' type="search" placeholder="CARI BERITA DI SINI" />
            </div>

        </div>

        <div class="grid grid-flow-dense grid-cols-1 ~gap-4/8 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">

            {{-- featured news --}}
            <div
                class="col-span-1 row-span-1 overflow-hidden rounded-xl shadow-top md:col-span-2 md:row-span-1 lg:row-span-3 2xl:[&:not(:only-child)]:mr-8">
                <img class="w-full object-cover" src="{{ asset('img/featured-news-thumb-demo.jpg') }}" alt="">
                <div class="flex h-full w-full flex-col gap-y-4 bg-white font-semibold ~p-4/8">
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
                <div class="flex overflow-hidden rounded-xl shadow-top">
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

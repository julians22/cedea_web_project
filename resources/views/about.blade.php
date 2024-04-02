@extends('layouts.app')

@section('content')

{{-- About 1 --}}
<section class="py-8 xl:py-10" id="tentang-cedea">
    <div class="container">
        <div class="flex max-w-full xl:max-w-4xl mx-auto flex-col lg:flex-row items-center">
            <div class="w-1/2 hidden lg:block">
                <img src="{{ asset('img/logo-cedea.png') }}" alt="" class="w-full">
            </div>
            <div class="w-full lg:w-1/2 p-4">
                <h1 class="cedea-title text-cedea-red mb-4">Pelopor Ikan Olahan Bermutu</h1>
                <p><strong>PT. CitraDimensi Arthali</strong> merupakan salah satu perusahaan di Indonesia yang bergerak di bidang pengolahan hasil perikanan dan manufaktur frozen seafood dengan brand CEDEA yang berlokasi di Muara Baru, Jakarta Utara.</p>
            </div>
        </div>
    </div>
</section>

{{-- About 2 --}}
<section class="bg-cedea-red xl:py-10 relative overflow-hidden md:h-[400px] lg:h-[500px] flex items-center justify-start flex-wrap lg:flex-nowrap" id="sejarah">
    <div class="container">
        <div class="w-full lg:w-1/2 p-4">
            <h2 class="cedea-title text-white mb-4">Komitmen <br> Sejak ‘95</h2>
            <p class="text-white mb-4">
                Berdiri sejak 1995, PT CitraDimensi Arthali juga merupakan pelopor industri makanan olahan berbasis hasil laut. kualitas dalam produksi setiap olahannya, dengan menerapkan teknologi produksi yang mutakhir, PT Citra Dimensi Arthali berhasil menjadi salah satu produsen makanan olahan berbasis hasil laut yang dipasarkan di berbagai pasar di Indonesia.
            </p>
            <a href="#" class="rounded-full px-4 py-2 bg-cedea-red text-white font-medium lg:font-semibold text-base lg:text-xl inline-flex self-center border border-white">
                Lihat Perjalanan Kami
            </a>
        </div>

    </div>

    <img src="{{ asset('img/cedea-industrial.jpg') }}" alt="" class="w-full lg:w-1/2 h-full relative lg:absolute lg:right-0 lg:top-0 object-right object-cover">
</section>

{{-- About 3 --}}
{{-- Visi Misi --}}
<section class="bg-left-top bg-repeat py-8 xl:py-10" style="background-size: 50%; background-image: url({{asset('img/pattern-visi-misi.webp')}})" id="visi-misi">
    <div class="container relative overflow-hidden">
        <div class="text-cedea-red cedea-title text-center mb-8">Visi & Misi Kami</div>
        <div class="flex space-x-0 lg:space-x-4 items-baseline justify-center lg:justify-normal flex-nowrap" x-data="{ open: 'visi' }">
            <article class="box-visi-misi visi"
                @click="open = 'visi'"
                x-bind:class="open === 'misi' ? 'in-back' : ''">
                <div class="bg-cedea-red p-6">
                    <h1 class="text-white cedea-title text-center mb-4">Visi</h1>
                    <p class="font-semibold text-white text-center">
                        Menjadi pemain unggul di bisnis makanan siap masak di Indonesia dan menjadi pilihan utama di pasar global tertentu
                    </p>
                </div>
                <div class="p-6 flex items-center flex-col space-y-6">
                    <div class="px-2 py-2 lg:py-1 font-bold bg-cedea-red text-white rounded-full text-center">Menjadi Pemain Unggul di Indonesia</div>
                    <p class="text-justify centered-bottom">
                        Kita harus lari lebih cepat mencapai pertumbuhan yang lebih tinggi dan diakui sebagai pemenan dibandingkan dengan pesaing dengan bisnis yang sejenis untuk wilayah Indonesia
                    </p>

                    <div class="px-2 py-2 lg:py-1 font-bold bg-cedea-red text-white rounded-full text-center">Menjadi Pilihan Utama di Pasar Global Tertentu</div>

                    <p class="text-justify centered-bottom">Kita harus mampu dan handal untuk menjadi bagian dari pemain global dengan mampu melalui mengeksport produk produk Cedea strategi pemasaran dan perencanaan yang cermat melalui penetrasi pasar global tertentu sehingga tercapai target bahwa produk CEDEA menjadi pilihan utama bagi masyarakat di daerah tersebut</p>
                </div>
                <div class="notation">
                    Visi
                </div>
            </article>
            <article class="box-visi-misi misi"
                @click="open = 'misi'"
                x-bind:class="open === 'visi' ? 'in-back' : ''">
                <div class="bg-cedea-red p-6">
                    <h1 class="text-white cedea-title text-center mb-4">Misi</h1>
                    <p class="font-semibold text-white text-center">
                        Aktif berperan dalam menyehatkan bangsa dengan membuat produk makanan bergizi aman dan bermanfaat untuk seluruh lapisan masyarakat melalui pendekatan inovasi dan teknologi serta perbaikan berkesinambungan
                    </p>
                </div>
                <div class="p-6 flex items-center flex-col space-y-6">
                    <div class="px-2 py-2 lg:py-1 font-bold bg-cedea-red text-white rounded-full text-center">AKTIF</div>
                    <div class="px-2 py-2 lg:py-1 font-bold border-2 border-cedea-red rounded-full text-center">GIGIH, GIAT, GESIT, proaktif dan gerak cepat</div>

                    <p class="text-justify centered-bottom">Aktif berperan dengan menghasilkan produk yang bergizi, aman dan "ONE TEAM" bukan hanya tanggung jawab bagian produksi saja tetapi semua bagian/departemen terlibat, sejauh mana raw material dipilih dengan kualitas yang baik, bagaimana bagian OC meningkatkan kualitas, bagaimana bagian Warehouse menyimpan dengan baik sehingga tidak terjadi kerusakan, PPIC, HRD, Fin & Acc, dst. Semua terlibat dan memiliki kontribusi masing-masing.</p>

                    <div class="px-2 py-2 lg:py-1 font-bold bg-cedea-red text-white rounded-full text-center">Inovasi dan Teknologi</div>

                    <p class="text-justify centered-bottom">Kita harus selalu mengikuti perkembangan pasar maupun teknologi, memiliki ide-ide baru untuk perbaikan, pembaharuan produk dan corrective action dalam perbaikan proses yang dijalankan</p>
                </div>
                <div class="notation">
                    Misi
                </div>
            </article>
        </div>
    </div>
</section>

{{-- Achieve Section --}}
<section class="bg-left-top bg-repeat py-8 xl:py-10" style="background-size: 50%; background-image: url({{asset('img/pattern-visi-misi.webp')}})" id="sertifikasi">
    <div class="container space-y-8 px-4 lg:px-0">
        <div class="text-cedea-red cedea-title text-center">Mutu yang Tetap Terjaga</div>
        <div class="flex space-x-0 lg:space-x-10 justify-around lg:justify-center flex-wrap">
            <div class="w-full max-w-24 lg:max-w-48">
                <img src="{{ asset('img/achieve-04.png') }}" class="w-full invert" alt="">
            </div>
            <div class="w-full max-w-24 lg:max-w-48">
                <img src="{{ asset('img/achieve-03.png') }}" class="w-full" alt="">
            </div>
            <div class="w-full max-w-24 lg:max-w-48">
                <img src="{{ asset('img/achieve-01.png') }}" class="w-full" alt="">
            </div>
            <div class="w-full max-w-24 lg:max-w-48">
                <img src="{{ asset('img/achieve-02.png') }}" class="w-full" alt="">
            </div>
        </div>

        <div>
            <p class="text-center">CEDEA SEAFOOD diproduksi oleh PT CitraDimensi Arthali yang berkomitmen untuk terus menghasilkan makanan beku dari ikan olahan terbaik dengan penerapan GMP, HACCP, ISO 22000, BPOM, Halal.</p>
        </div>
    </div>
</section>


@endsection


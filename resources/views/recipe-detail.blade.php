<x-layouts.app>
    <x-video-player />

    <section class="container my-8 grid grid-cols-[25%_1fr]">

        <div>
            <img src="{{ asset('placeholder/product.png') }}" alt="">
        </div>

        <div class="prose">
            <div class="flex flex-col gap-2">
                <p class="uppercase ~text-base/2xl">cedea salmon sosis keju</p>
                <h1 class="~text-xl/5xl">Sosis Kentang Korea</h1>
            </div>

            <div>
                <p>Bahan Utama:</p>

                <ul>
                    <li>6 buah CEDEA Salmon Sosis Keju, potong iris-iris</li>
                    <li>2 buah Kentang, potong dadu, goreng, sisihkan</li>
                    <li>3 siung Bawang putih, cincang</li>
                    <li>1/2 buah Bawang bombay, iris memanjang</li>
                    <li>1 btg Daun bawang, rajang</li>
                    <li>Secukupnya Air matang</li>
                </ul>

                Cara Membuat:
                <ol class="list-decimal">
                    <li>Tumis bawang putih hingga harum, masukkan sosis dan bawang bombay, tumis sebentar</li>
                    <li>Masukan bahan saus dan air secukupnya.</li>
                    <li>Masukan kentang goreng dan daun bawang, aduk rata.</li>
                    <li>Angkat dan sajikan.</li>
                </ol>
            </div>
        </div>
    </section>
</x-layouts.app>

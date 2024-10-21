<section class="min-h-dvh bg-cedea-red bg-shippo bg-left-top bg-repeat pt-36 bg-blend-multiply">

    <div class="grid-overlay grid">
        <div class="container grid grid-cols-2 gap-4 text-white">
            <div>
                <h1 class="section-title text-white">Hubungi Kami</h1>
                <div class="grid grid-cols-[auto_1fr] gap-x-4 gap-y-8">
                    <x-contact.item>
                        <x-slot:icon>
                            <x-lucide-home />
                        </x-slot:icon>
                        <div class="flex flex-col gap-8">
                            <div>
                                <div class="text-xl">PT CitraDimensi Arthali</div>
                                <div class='text-lg font-semibold'>Sudirman - Head Office</div>
                                <div>
                                    Sudirman 7.8, 20th Fl. Unit 01
                                    Jl. Jend. Sudirman Kav. 7-8
                                    Jakarta Pusat 10220 - Indonesia
                                </div>
                                <div>(021) 3020 3333</div>
                            </div>
                            <div>
                                <div>Muara Baru Operations Office</div>
                                <div class='text-lg font-semibold'>
                                    "Perum Prasarana Perikanan Samudera
                                    Blok N, No 12, Muara Baru Jakarta Utara,
                                    14440, Indonesia
                                </div>
                                <div>(021) 6602092</div>
                            </div>
                        </div>
                    </x-contact.item>
                    <x-contact.item>
                        <x-slot:icon>
                            <x-lucide-phone />
                        </x-slot:icon>
                        <p>+6221 660 2092</p>
                    </x-contact.item>
                    <x-contact.item>
                        <x-slot:icon>
                            <x-lucide-mail />
                        </x-slot:icon>
                        <p>info@cedeaseafood.com</p>
                    </x-contact.item>
                </div>
            </div>
        </div>

        {{-- form --}}
        <form class="grid-overlay pointer-events-none grid" wire:submit="send">
            <div class="grid-overlay pointer-events-none grid">
                <div class="col-start-2 bg-white"></div>
            </div>
            <div class="container pointer-events-none grid text-cedea-red-500 lg:grid-cols-2">
                <div class="pointer-events-auto col-start-2 bg-white p-8">
                    <h2 class="section-title">Tinggalkan Pesan</h2>

                    <div class="mb-8 flex gap-4">
                        <button wire:click='handleTabChange(0)' @class([
                            'px-3 py-1 transition-all rounded-full border-2 border-cedea-red-500',
                            'bg-cedea-red-500 text-white' => $tabIndex == 0,
                        ])>
                            Pertanyaan Umum
                        </button>
                        <button wire:click='handleTabChange(1)' @class([
                            'px-3 py-1 transition-all rounded-full border-2 border-cedea-red-500',
                            'bg-cedea-red-500 text-white' => $tabIndex == 1,
                        ])>
                            Pendaftaran Kunjungan Pabrik
                        </button>
                    </div>

                    <div class="contact-form-wrapper flex flex-col gap-4 font-semibold">

                        <div>
                            <label for="name">Nama</label>
                            <input placeholder="Nama" type="text" name="name" wire:model="name">
                        </div>

                        <div>
                            <label for="email">Email</label>
                            <input placeholder="Email" type="text" name="email" wire:model="email">
                        </div>

                        @if ($tabIndex == 0)
                            <div>
                                <label for="subject">Perihal</label>
                                <input placeholder="Perihal" type="text" name="subject" wire:model="subject">
                            </div>

                            <div>
                                <label for="message">Pesan</label>
                                <textarea rows="5" placeholder="Pesan" type="text" name="messagge" wire:model="message"></textarea>
                            </div>
                        @endif

                        <button type="submit" @class([
                            'px-4 rounded-full w-fit border-2 border-cedea-red-500',
                            true => 'bg-cedea-red-500 text-white',
                        ])>Kirim</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

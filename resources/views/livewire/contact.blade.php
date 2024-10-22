<section class="min-h-dvh bg-cedea-red bg-shippo bg-left-top bg-repeat bg-blend-multiply ~py-16/36">

    <div class="lg:grid-overlay grid max-lg:gap-y-8">
        <div class="container grid gap-4 text-white lg:grid-cols-2">
            <div>
                <h1 class="section-title text-white">Hubungi Kami</h1>
                <div class="grid grid-cols-[auto_1fr] ~text-base/lg ~gap-x-2/4 ~gap-y-4/8">
                    <x-contact.item>
                        <x-slot:icon>
                            <x-lucide-home />
                        </x-slot:icon>
                        <div class="flex flex-col ~gap-4/8">
                            <div>
                                <div class="~text-lg/xl">PT CitraDimensi Arthali</div>
                                <div class='font-semibold ~text-base/lg'>Sudirman - Head Office</div>
                                <div>
                                    Sudirman 7.8, 20th Fl. Unit 01
                                    Jl. Jend. Sudirman Kav. 7-8
                                    Jakarta Pusat 10220 - Indonesia
                                </div>
                                <div>(021) 3020 3333</div>
                            </div>
                            <div>
                                <div class="~text-lg/xl">Muara Baru Operations Office</div>
                                <div class='font-semibold'>
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
            <div class="pointer-events-none grid max-lg:hidden lg:grid-cols-2">
                <div class="col-start-2 bg-white"></div>
            </div>

            <div class="container pointer-events-none grid text-cedea-red-500 lg:grid-cols-2">
                <div class="pointer-events-auto bg-white ~p-4/8 lg:col-start-2">
                    <h2 class="section-title">Tinggalkan Pesan</h2>

                    <div class="mb-8 flex gap-4 max-lg:flex-col">
                        <button wire:loading.attr="disabled" wire:click='handleTabChange(0)'
                            @class([
                                'px-3 py-1 transition-all rounded-full border-2 border-cedea-red-500',
                                'bg-cedea-red-500 text-white' => $tabIndex == 0,
                            ])>
                            Pertanyaan Umum
                        </button>
                        <button wire:loading.attr="disabled" wire:click='handleTabChange(1)'
                            @class([
                                'px-3 py-1 transition-all rounded-full border-2 border-cedea-red-500',
                                'bg-cedea-red-500 text-white' => $tabIndex == 1,
                            ])>
                            Pendaftaran Kunjungan Pabrik
                        </button>
                    </div>

                    <div class="contact-form-wrapper flex flex-col gap-4 font-semibold">

                        <div>
                            <label for="name">Nama</label>
                            <input wire:loading.attr="disabled" placeholder="Nama" type="text" name="name"
                                wire:model="name">
                            <div class="text-sm font-normal">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email">Email</label>
                            <input wire:loading.attr="disabled" placeholder="Email" type="text" name="email"
                                wire:model="email">
                            <div class="text-sm font-normal">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        @if ($tabIndex == 0)
                            <div>
                                <label for="subject">Perihal</label>
                                <input wire:loading.attr="disabled" placeholder="Perihal" type="text" name="subject"
                                    wire:model="subject">
                                <div class="text-sm font-normal">
                                    @error('subject')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="message">Pesan</label>
                                <textarea wire:loading.attr="disabled" rows="5" placeholder="Pesan" type="text" name="message"
                                    wire:model="message"></textarea>
                                <div class="text-sm font-normal">
                                    @error('message')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <button wire:loading.attr="disabled" type="submit" @class([
                            'px-4 rounded-full w-fit border-2 border-cedea-red-500',
                            true => 'bg-cedea-red-500 text-white',
                        ])>Kirim</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

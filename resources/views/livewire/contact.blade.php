<section class="min-h-dvh bg-cedea-red bg-shippo bg-left-top bg-repeat bg-blend-multiply ~py-16/36"
    x-data="{ messageSent: false }" x-on:message-sent="messageSent=true">

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

            <div class="container pointer-events-none grid text-cedea-red-500 lg:grid-cols-2" x-show="!messageSent"
                x-cloak>

                <div class="pointer-events-auto relative bg-white ~p-4/8 lg:col-start-2">
                    <h2 class="section-title">Tinggalkan Pesan</h2>

                    <div class="mb-8 flex gap-4 max-lg:flex-col">
                        <button type="button" wire:loading.attr="disabled" wire:click='handleTabChange(0)'
                            @class([
                                'px-3 py-1 transition-all rounded-full border-2 border-cedea-red-500',
                                'bg-cedea-red-500 text-white' => $tabIndex == 0,
                            ])>
                            Pertanyaan Umum
                        </button>
                        <button type="button" wire:loading.attr="disabled" wire:click='handleTabChange(1)'
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
                        ])>
                            <span class="items-center justify-center" wire:loading.flex wire:target="send">
                                <svg class="-ml-1 mr-3 h-5 w-5 animate-spin text-white" data-motion-id="svg 2"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4">
                                    </circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Processing...
                            </span>

                            <span wire:loading.remove wire:target="send">
                                Kirim
                            </span>
                        </button>
                    </div>

                </div>
            </div>

            {{-- pop-up --}}
            <div class="container pointer-events-none grid lg:grid-cols-2" x-show="messageSent" x-cloak>
                <div class="pointer-events-auto relative lg:col-start-2">
                    <x-lucide-circle-x class="size-12 absolute right-4 top-6 cursor-pointer rounded-full"
                        @click="messageSent=false" />

                    <div class="flex flex-col items-start justify-center gap-12 rounded-md px-10 py-14 font-medium">
                        <h2 class="section-title" :capitalize='false' align='left'>
                            Terima kasih sudah menghubungi kami, pesan anda sedang kami proses.
                        </h2>
                        <button
                            class="h-10 w-40 cursor-pointer items-center justify-center overflow-hidden rounded-full border-none bg-cedea-red-500 text-white shadow-md"
                            type="button" @click="messageSent=false">
                            Tutup Pesan
                        </button>
                    </div>
                </div>
            </div>
            {{-- pop-up end --}}
        </form>
    </div>
</section>

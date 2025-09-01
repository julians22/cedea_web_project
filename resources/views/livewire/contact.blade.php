@php
    use App\Settings\ContactSettings;
    $settings = app(ContactSettings::class);
@endphp

<section class="min-h-dvh bg-cedea-red bg-shippo bg-left-top bg-repeat bg-blend-multiply ~py-16/36"
    x-data="{ messageSent: false }" x-on:message-sent="messageSent=true">

    <div class="lg:grid-overlay grid max-lg:gap-y-8">
        <div class="container grid text-white max-lg:order-2 md:gap-x-80 lg:grid-cols-2">
            <div>
                <h1 class="section-title text-white">{{ __('contact.heading') }}</h1>
                <div class="grid grid-cols-[auto_1fr] ~text-base/lg ~gap-x-2/4 ~gap-y-4/8">
                    <x-contact.item>
                        <x-slot:icon>
                            <x-icon.building />
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
                                <a href="tel:(021) 3020 3333">(021) 3020 3333</a>
                            </div>
                            <div>
                                <div class="font-semibold ~text-lg/xl">Muara Baru Operations Office</div>
                                <div class=''>
                                    Perum Prasarana Perikanan Samudera
                                    Blok N, No 12, Muara Baru Jakarta Utara,
                                    14440, Indonesia
                                </div>
                                <a href="tel:(021) 6602092">(021) 6602092</a>
                            </div>
                        </div>
                    </x-contact.item>


                    @if ($settings->enable_photos)
                        <x-contact.item>
                            <x-slot:icon>
                                {{-- intentionally left empty --}}
                            </x-slot:icon>

                            @php
                                $locations = ['Jakarta', 'Majalengka', 'Semarang', 'Medan'];
                            @endphp

                            <div class="grid grid-cols-2 gap-20 py-8">
                                @foreach ($locations as $location)
                                    <figure class="polaroid">
                                        <img src="{{ asset('img/contact/factory.png') }}" alt="cedea factory">
                                        <figcaption class="text-center text-white">{{ $location }}</figcaption>
                                    </figure>
                                @endforeach
                            </div>
                        </x-contact.item>
                    @endif

                    <x-contact.item>
                        <x-slot:icon>
                            <x-icon.phone />
                        </x-slot:icon>
                        <a href="telp:+6221 660 2092">+6221 660 2092</a>
                    </x-contact.item>

                    <x-contact.item>
                        <x-slot:icon>
                            <x-icon.mail />
                        </x-slot:icon>
                        <a href="mailto:info@cedeaseafood.com">info@cedeaseafood.com</a>
                    </x-contact.item>
                </div>
            </div>
        </div>

        {{-- form --}}
        <form class="grid-overlay pointer-events-none order-1 grid" @submit.prevent="doCaptcha" x-data="{
            loading: false,
            siteKey: @js(config('services.recaptcha.public_key')),
            init() {
                // load our recaptcha.
                if (!window.recaptcha) {
                    const script = document.createElement('script');
                    script.src = 'https://www.google.com/recaptcha/api.js?render=' + this.siteKey;
                    document.body.append(script);
                }
            },
            doCaptcha() {
                grecaptcha.execute(this.siteKey, { action: 'submit' }).then(token => {
                    Livewire.dispatch('formSubmitted', { token: token });
                });
            },
        }">
            <span class="pointer-events-none grid after:col-start-2 after:bg-white max-lg:hidden lg:grid-cols-2"></span>

            <div class="container pointer-events-none grid text-cedea-red-500 lg:grid-cols-2" x-show="!messageSent"
                x-cloak>

                <div class="pointer-events-auto relative bg-white ~p-4/8 lg:col-start-2">
                    <h2 class="section-title">{{ __('contact.form.heading') }}</h2>

                    <div class="mb-8 flex gap-4 max-lg:flex-col">
                        @if ($settings->enable_inquiry_form)
                            <button type="button" wire:loading.attr="disabled" wire:click='handleTabChange(0)'
                                @class([
                                    'px-3 py-1 transition-all rounded-full border-2 border-cedea-red-500',
                                    'bg-cedea-red-500 text-white' => $tab_index == 0,
                                ])>
                                {{ __('contact.general') }}
                            </button>
                        @endif

                        @if ($settings->enable_visit_form)
                            <button type="button" wire:loading.attr="disabled" wire:click='handleTabChange(1)'
                                @class([
                                    'px-3 py-1 transition-all rounded-full border-2 border-cedea-red-500',
                                    'bg-cedea-red-500 text-white' => $tab_index == 1,
                                ])>
                                {{ __('contact.visit') }}
                            </button>
                        @endif
                    </div>

                    @if ($this->isFormEnabled)
                        <div class="contact-form-wrapper flex flex-col gap-4 font-semibold">


                            @if ($tab_index == 0 && $settings->enable_inquiry_form)
                                <x-contact.form-inquiry />
                            @endif

                            @if ($tab_index == 1 && $settings->enable_visit_form)
                                <x-contact.form-visit />
                            @endif

                            {{-- loading button state --}}
                            <div class="flex w-fit cursor-progress items-center justify-center rounded-full border-2 border-cedea-red-500 bg-cedea-red-500 px-4 text-white"
                                wire:loading>
                                <span
                                    class="pointer-events-none inline-flex items-center justify-center gap-2 opacity-50">
                                    <svg class="h-5 w-5 animate-spin text-white" data-motion-id="svg 2"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4">
                                        </circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    <span>Processing...</span>
                                </span>
                            </div>

                            <button type="submit" wire:loading.remove wire:loading.attr="disabled"
                                :disabled="loading"
                                :class="{
                                    'px-4 rounded-full w-fit border-2 flex items-center justify-center border-cedea-red-500': true,
                                    'bg-cedea-red-500 cursor-progress text-white': loading
                                }">
                                <span class="items-center justify-center"
                                    x-bind:class="{
                                        'inline-flex gap-2 opacity-50 pointer-events-none': loading
                                    }">
                                    <svg class="h-5 w-5 animate-spin text-white" data-motion-id="svg 2" wire:loading
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        x-show="loading">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4">
                                        </circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    <span x-show="!loading" wire:loading.remove>{{ __('contact.submit') }}</span>
                                    <span x-show="loading" wire:loading>Processing...</span>
                                </span>
                            </button>

                            @error('recaptcha')
                                <div class="rounded bg-red-300 p-3 text-red-700">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                </div>
            </div>

            {{-- pop-up --}}
            <x-form.pop-up show="messageSent" />
            {{-- pop-up end --}}
        </form>
    </div>
</section>

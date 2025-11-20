@if (env('SHOW_POPUP', false))
    <div class="fixed left-0 top-0 z-50 size-full bg-black/50" x-show="visible" x-transition style="display: none;"
        x-data="{
            visible: true,
            checkVisit() {
                // this.visible = true;
                // localStorage.setItem('popupShown', 'true');
            },
            close() {
                this.visible = false;
            }
        }" x-init="checkVisit()">
        <div class="relative">
            <div class="relative mx-auto flex h-dvh w-fit items-center justify-center px-8 py-4 shadow-lg">
                <a class="inline-flex h-full w-auto items-center justify-center"
                    href="https://eomuk-bar-rte.cedeaseafood.com?source=pop-up-banner" target="_blank"
                    @click.outside="visible=false">
                    <img class="h-fit max-h-full w-auto" src="{{ asset('img/pop/eomuk.png') }}" alt="">
                </a>

                <button
                    class="absolute right-2 top-2 z-1 mr-5 mt-5 flex items-center justify-center rounded-full bg-gray-50 text-gray-800 hover:bg-white md:hidden"
                    @click="visible=false">
                    <svg class="size-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="0.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
@endif

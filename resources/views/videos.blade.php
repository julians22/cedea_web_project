<x-layouts.app>

    <x-video-player :loop="false" source_mp4="{{ asset('video/product.mp4') }}" />

    <div class="bg-cedea-red">
        <x-section-banner class="container" class:title="text-white mb-0" class:desc="text-white" id="sejarah"
            :imageLeft="false" :gradient="false" imageUrl="{{ asset('img/marketplace/section-1.png') }}"
            :title="__('videos.explore.title')">
            <x-slot:desc>
                <p>
                    {{ __('videos.explore.desc') }}
                </p>
            </x-slot:desc>
            <x-slot:button>
                <a class="w-fit rounded-full bg-white px-4 py-2 text-cedea-red" href="youtube.com">
                    {{ __('videos.visit_now') }}
                </a>
            </x-slot>
        </x-section-banner>
    </div>

    <livewire:show-recipe-videos />

    <livewire:show-tv-videos />

    <section class="bg-gradient-to-t from-gray-500 to-gray-500/10 py-10">
        <div class="container flex flex-wrap items-center justify-center gap-16">
            @php
                $footerIcons = [
                    ['title' => 'Event CEDEA', 'href' => '#', 'icon' => asset('img/videos/footer/calendar.png')],
                    ['title' => 'Review CEDEA', 'href' => '#', 'icon' => asset('img/videos/footer/dialog.png')],
                    ['title' => 'Cooking Demo', 'href' => '#', 'icon' => asset('img/videos/footer/pot.png')],
                ];
            @endphp

            @foreach ($footerIcons as $icon)
                <div class="flex flex-col items-center justify-between gap-2">
                    <img class="w-auto max-w-32" src="{{ $icon['icon'] }}" alt="icon">
                    <a class="block w-full rounded-full bg-cedea-red px-3 py-1 text-center text-lg font-bold text-white"
                        href="{{ $icon['href'] }}">
                        {{ $icon['title'] }}
                    </a>
                </div>
            @endforeach

            <div class="flex flex-col items-center justify-between gap-2">
                <img class="w-auto max-w-32" src="{{ asset('img/videos/footer/cedea.png') }}" alt="icon">
                <p>CEDEA Seafood</p>
                <a class="block w-full rounded-full bg-black px-3 py-1 text-center text-lg font-bold text-white"
                    href="#">
                    Subscribe
                </a>
            </div>
        </div>

    </section>

</x-layouts.app>

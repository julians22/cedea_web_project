<x-layouts.app>

    <x-video-player :loop="false" source_mp4="{{ asset('video/product.mp4') }}" />

    <section class="bg-cedea-red">
        <x-section-banner class="container" class:title="text-white mb-0" class:desc="text-white" id="sejarah"
            :imageLeft="false" :gradient="false"
            imageUrl="https://cdn3.iconfinder.com/data/icons/social-network-30/512/social-06-512.png" :title="__('videos.explore.title')">
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
    </section>

    <livewire:show-recipe-videos />
    <livewire:show-tv-videos />

</x-layouts.app>

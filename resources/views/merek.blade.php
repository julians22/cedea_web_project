<x-layouts.app>

    <section class="aspect-video">
        <img src="{{ asset('img/video-placeholder.jpg') }}" alt="">
        {{-- <video src="" autoplay></video> --}}
    </section>

    <livewire:frontend.products :tags="$tags" :categories="$categories" />

</x-layouts.app>

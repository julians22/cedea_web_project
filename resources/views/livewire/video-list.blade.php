<section class='container my-12' x-data="{ modalOpen: false }">

    <h2 class="section-title text-center" wire:ignore>{{ $title }}</h2>

    <div class="grid grid-cols-1 gap-x-8 gap-y-8 sm:grid-cols-2 md:grid-cols-3">
        @foreach ($videos as $video)
            <x-video-item :video="$video" />
        @endforeach
    </div>

    <div class="pt-4">
        {{ $videos->links('vendor.livewire.cedea', data: ['scrollTo' => false]) }}
    </div>

    <x-modal-video>

        <div class="text-white" wire:loading.remove wire:target='handleChangeActiveVideo'>
            @if ($activeVideo)
                <x-matinee::embed :data="$activeVideo->video" />
            @endif
        </div>

        {{-- skeleton --}}
        <div class="space-y-4 text-white" wire:loading wire:target='handleChangeActiveVideo'>
        </div>
    </x-modal-video>

</section>

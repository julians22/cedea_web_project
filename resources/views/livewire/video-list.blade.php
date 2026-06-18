<section class="container my-12" x-data="videoList($wire.entangle('modalOpen').live)">

    <h2 class="section-title text-center" wire:ignore>{{ $title }}</h2>

    <div class="grid grid-cols-1 gap-x-8 gap-y-8 sm:grid-cols-2 md:grid-cols-3">
        @foreach ($videos as $video)
            <x-video-item :list-name="$title" :video="$video" />
        @endforeach
    </div>

    <div class="pt-4">
        {{ $videos->links('vendor.livewire.cedea', data: ['scrollTo' => false]) }}
    </div>

    <x-modal-video>

        <div class="text-white" wire:loading.remove wire:target='handleChangeActiveVideo'>
            @if ($activeVideo)
                <div data-active-video data-video-id="{{ $activeVideo->slug }}"
                    data-video-title="{{ strip_tags((string) $activeVideo->title) }}"
                    data-video-type="{{ $activeVideo->type }}" data-video-list-id="{{ $activeVideo->type }}_videos"
                    data-video-list-name="{{ $title }}" x-init="$nextTick(() => trackVideoView($el.dataset))">
                    <x-matinee::embed :data="$activeVideo->video" />
                </div>
            @endif
        </div>

        {{-- skeleton --}}
        <div class="space-y-4 text-white" wire:loading wire:target='handleChangeActiveVideo'>
        </div>
    </x-modal-video>

</section>

@script
    <script>
        if (!window.cedeaVideoAnalyticsRegistered) {
            window.cedeaVideoAnalyticsRegistered = true;

            Alpine.data('videoList', (modalOpen) => ({
                modalOpen,
                viewedVideoId: null,
                init() {
                    this.$watch('modalOpen', (value) => {
                        if (!value) {
                            this.viewedVideoId = null;
                        }
                    });
                },
                videoParams(video) {
                    return {
                        content_type: 'video',
                        item_id: video.videoId,
                        item_name: video.videoTitle,
                        video_id: video.videoId,
                        video_title: video.videoTitle,
                        video_type: video.videoType,
                        item_list_id: video.videoListId,
                        item_list_name: video.videoListName,
                    };
                },
                trackVideoSelection(video) {
                    if (typeof window.gtag !== 'function') return;

                    window.gtag('event', 'select_content', this.videoParams(video));
                },
                trackVideoView(video) {
                    if (this.viewedVideoId === video.videoId || typeof window.gtag !== 'function') return;

                    this.viewedVideoId = video.videoId;

                    window.gtag('event', 'view_video', this.videoParams(video));
                },
            }));
        }
    </script>
@endscript

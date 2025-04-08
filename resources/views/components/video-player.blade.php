@props([
    'source_mp4' => null,
    'source_webm' => null,
    'source_ogg' => null,
    'poster' => null,
    'muted' => true,
    'controls' => true,
    'showTime' => true,
    'loop' => true,
    'autoHideControls' => true,
])

@php

@endphp

<div class="relative aspect-video overflow-hidden" x-data="{
    sources: {
        mp4: '{{ $source_mp4 }}',
        webm: '{{ $source_webm }}',
        ogg: '{{ $source_ogg }}'
    },
    playing: true,
    controls: true,

    loop: {{ $loop ? 'true' : 'false' }},
    muted: true,

    fullscreen: false,
    ended: false,
    mouseleave: false,
    autoHideControlsDelay: 3000,
    controlsHideTimeout: null,
    poster: null,
    videoDuration: 0,
    timeDurationString: '00:00',
    timeElapsedString: '00:00',
    showTime: false,
    volume: 1,
    volumeBeforeMute: 1,
    videoPlayerReady: true,
    videoPlayerReady: false,
    timelineSeek(e) {
        time = this.formatTime(Math.round(e.target.value));
        this.timeElapsedString = `${time.minutes}:${time.seconds}`;
    },
    metaDataLoaded(event) {
        this.videoDuration = event.target.duration;

        time = this.formatTime(Math.round(this.videoDuration));
        this.timeDurationString = `${time.minutes}:${time.seconds}`;
        this.showTime = true;
        this.videoPlayerReady = true;
    },
    togglePlay(e) {
        if (this.$refs.player.paused || this.$refs.player.ended) {
            this.playing = true;
            this.$refs.player.play();
        } else {
            this.$refs.player.pause();
            this.playing = false;
        }
    },
    toggleMute() {
        this.muted = !this.muted;
        this.$refs.player.muted = this.muted;
        if (this.muted) {
            this.volumeBeforeMute = this.volume;
            this.volume = 0;
        } else {
            this.volume = this.volumeBeforeMute;
        }
    },
    timeUpdatedInterval() {
        this.$refs.videoProgress.value = this.$refs.player.currentTime;
        time = this.formatTime(Math.round(this.$refs.player.currentTime));
        this.timeElapsedString = `${time.minutes}:${time.seconds}`;
    },
    updateVolume(e) {
        this.volume = e.target.value;
        this.$refs.player.volume = this.volume;
        if (this.volume == 0) {
            this.muted = true;
        }

        if (this.muted && this.volume > 0) {
            this.muted = false;
        }
    },
    timelineClicked(e) {
        rect = this.$refs.videoProgress.getBoundingClientRect();
        pos = (e.pageX - rect.left) / this.$refs.videoProgress.offsetWidth;
        this.$refs.player.currentTime = pos * this.$refs.player.duration;
    },
    handleFullscreen() {
        if (document.fullscreenElement !== null) {
            // The document is in fullscreen mode
            document.exitFullscreen();
        } else {
            // The document is not in fullscreen mode
            this.$refs.videoContainer.requestFullscreen();
        }
    },
    mousemoveVideo() {
        if (this.playing) {
            this.resetControlsTimeout();
        } else {
            this.controls = true;
            clearTimeout(this.controlsHideTimeout);
        }
    },
    videoEnded() {
        this.ended = true;
        this.playing = false;
        this.$refs.player.currentTime = 0;
    },
    resetControlsTimeout() {
        this.controls = true;
        clearTimeout(this.controlsHideTimeout);
        let that = this;
        this.controlsHideTimeout = setTimeout(function() {
            that.controls = false
        }, this.autoHideControlsDelay);
    },
    formatTime(timeInSeconds) {
        result = new Date(timeInSeconds * 1000).toISOString().substring(11, 19);

        return {
            minutes: result.substring(3, 5),
            seconds: result.substring(6, 8),
        };
    }
}" x-init="$refs.player.load();
// Hide the default player controls
$refs.player.controls = false;

if (!this.loop) {
    $refs.player.loop = false;
}


$watch('playing', (value) => {
    if (value) {
        ended = false;
        controlsHideTimeout = setTimeout(() => {
            controls = false;
        }, autoHideControlsDelay);
    } else {
        clearTimeout(controlsHideTimeout);
        controls = true;
    }
});

if (!document?.fullscreenEnabled) {
    $refs.fullscreenButton.style.display = 'none';
}

document.addEventListener('fullscreenchange', (e) => {
    fullscreen = !!document.fullscreenElement;
});" x-ref="videoContainer"
    @mouseleave="mouseleave=true" @mousemove="mousemoveVideo" x-cloak>

    <video class="relative h-full w-full bg-black object-cover" x-ref="player" @loadedmetadata="metaDataLoaded"
        @ended="videoEnded" autoplay muted preload="metadata" :loop="loop" :poster="poster"
        crossorigin="anonymous">
        <source :src="sources.mp4" type="video/mp4" />

        @if ($source_ogg)
            <source :src="sources.ogg" type="video/ogg" />
        @endif

        @if ($source_webm)
            <source :src="sources.webm" type="video/webm" />
        @endif
    </video>

    <div class="absolute inset-0 h-full w-full" x-show="videoPlayerReady">

        <div class="absolute bottom-0 left-0 z-1 h-1/2 w-full bg-gradient-to-b from-transparent to-black opacity-20"
            x-show="controls" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-full" x-cloak>
        </div>

        <ul class="absolute z-10 flex w-full items-center justify-end text-black ~right-4/20 ~bottom-4/16"
            x-show="controls" @click="resetControlsTimeout" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-full" x-cloak>
            <li class="inline rounded-l-full bg-white pl-2">
                <button
                    class="flex items-center justify-center opacity-80 duration-150 ease-out ~h-7/10 ~w-9/12 ~pr-3/4 ~pl-2/3 hover:opacity-100"
                    @click="togglePlay()" type="button">

                    <x-lucide-pause x-show="playing" x-cloak />
                    <x-lucide-play x-show="!playing" x-cloak />

                </button>
            </li>

            <li class="w-0.5 bg-black" aria-hidden="true"></li>

            <li class="inline rounded-r-full bg-white">
                <button
                    class="flex items-center justify-center opacity-80 duration-150 ease-out ~h-7/10 ~w-9/12 ~pr-3/4 ~pl-2/3 hover:opacity-100"
                    @click="toggleMute()" type="button">

                    <x-lucide-volume-2 x-show="!muted" x-cloak />
                    <x-lucide-volume-x x-show="muted" x-cloak />

                </button>

            </li>
        </ul>
    </div>
</div>

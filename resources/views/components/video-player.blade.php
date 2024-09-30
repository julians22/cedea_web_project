<div class="relative aspect-video min-w-[640px] overflow-hidden rounded-md" x-data="{
    sources: {
        mp4: 'https://cdn.devdojo.com/pines/videos/coast.mp4',
        webm: 'https://cdn.devdojo.com/pines/videos/coast.webm',
        ogg: 'https://cdn.devdojo.com/pines/videos/coast.ogg'
    },
    playing: true,
    controls: true,
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
});"
    x-ref="videoContainer" @mouseleave="mouseleave=true" @mousemove="mousemoveVideo" x-cloak>
    <video class="relative h-full w-full bg-black object-cover" x-ref="player" @loadedmetadata="metaDataLoaded" loop
        autoplay @ended="videoEnded" preload="metadata" muted :poster="poster" crossorigin="anonymous">
        <source :src="sources.mp4" type="video/mp4" />
        <source :src="sources.webm" type="video/webm" />
        <source :src="sources.ogg" type="video/ogg" />
    </video>
    <div class="absolute inset-0 h-full w-full" x-show="videoPlayerReady">

        <div class="absolute bottom-0 left-0 z-1 h-1/2 w-full bg-gradient-to-b from-transparent to-black opacity-20"
            x-show="controls" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-full" x-cloak>
        </div>

        <ul class="absolute bottom-16 right-20 z-10 flex w-full items-center justify-end text-black" x-show="controls"
            @click="resetControlsTimeout" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-full" x-cloak>
            <li class="inline rounded-l-full bg-white pl-2">
                <button
                    class="flex h-10 w-10 items-center justify-center opacity-80 duration-150 ease-out hover:opacity-100"
                    @click="togglePlay()" type="button">
                    <svg class="h-5 w-5" x-show="!playing" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.42737 3.41611C6.46665 2.24586 4.00008 3.67188 4.00007 5.9427L4 18.0572C3.99999 20.329 6.46837 21.7549 8.42907 20.5828L18.5698 14.5207C20.4775 13.3802 20.4766 10.6076 18.568 9.46853L8.42737 3.41611Z"
                            fill="currentColor" x-cloak></path>
                    </svg>
                    <svg class="h-5 w-5" x-show="playing" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8 3C8.55228 3 9 3.44772 9 4L9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20L7 4C7 3.44772 7.44772 3 8 3ZM16 3C16.5523 3 17 3.44772 17 4V20C17 20.5523 16.5523 21 16 21C15.4477 21 15 20.5523 15 20V4C15 3.44772 15.4477 3 16 3Z"
                            fill="currentColor" x-cloak></path>
                    </svg>
                </button>
            </li>

            <li class="w-0.5 bg-black" aria-hidden="true"></li>

            <li class="inline rounded-r-full bg-white">
                <button
                    class="flex h-10 w-6 items-center justify-center pl-3 pr-4 opacity-80 duration-150 ease-out hover:opacity-100"
                    @click="toggleMute()" type="button">
                    <svg class="h-[18px] w-[18px]" x-show="!muted" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="currentColor" x-cloak>
                        <path
                            d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 001.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06zM18.584 5.106a.75.75 0 011.06 0c3.808 3.807 3.808 9.98 0 13.788a.75.75 0 11-1.06-1.06 8.25 8.25 0 000-11.668.75.75 0 010-1.06z" />
                        <path
                            d="M15.932 7.757a.75.75 0 011.061 0 6 6 0 010 8.486.75.75 0 01-1.06-1.061 4.5 4.5 0 000-6.364.75.75 0 010-1.06z" />
                    </svg>
                    <svg class="h-[18px] w-[18px]" x-show="muted" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" x-cloak>
                        <path
                            d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 001.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06zM17.78 9.22a.75.75 0 10-1.06 1.06L18.44 12l-1.72 1.72a.75.75 0 001.06 1.06l1.72-1.72 1.72 1.72a.75.75 0 101.06-1.06L20.56 12l1.72-1.72a.75.75 0 00-1.06-1.06l-1.72 1.72-1.72-1.72z" />
                    </svg>
                </button>

            </li>
        </ul>
    </div>
</div>

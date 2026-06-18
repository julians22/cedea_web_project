<?php

namespace App\Traits;

use App\Enums\VideoType;
use App\Models\Video;
use Livewire\Attributes\Url;

trait VideoPopUp
{
    #[Url(as: 'video', except: null, history: true)]
    public ?string $videoSlug = null;

    public $activeVideo = null;

    public bool $modalOpen = false;

    abstract protected function videoType(): VideoType;

    public function initializeVideoFromUrl(): void
    {
        $this->syncActiveVideo();
    }

    public function handleChangeActiveVideo(string $slug = ''): void
    {
        $this->videoSlug = $slug !== '' ? $slug : null;
        $this->syncActiveVideo();
    }

    public function updatedVideoSlug(): void
    {
        $this->syncActiveVideo();
    }

    private function syncActiveVideo(): void
    {
        $this->activeVideo = Video::query()
            ->where('type', $this->videoType()->value)
            ->where('slug', $this->videoSlug)
            ->first();

        $this->modalOpen = $this->activeVideo !== null;
    }
}

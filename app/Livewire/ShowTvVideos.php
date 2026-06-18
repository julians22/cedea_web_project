<?php

namespace App\Livewire;

use App\Enums\VideoType;
use App\Models\Video;
use App\Traits\VideoPopUp;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTvVideos extends Component
{
    use VideoPopUp, WithPagination;

    public function mount(): void
    {
        $this->initializeVideoFromUrl();
    }

    protected function videoType(): VideoType
    {
        return VideoType::TV;
    }

    public function render(): View
    {
        return view('livewire.video-list', [
            'title' => __('videos.type.tv'),
            'videos' => Video::query()
                ->where('type', VideoType::TV)
                ->latest()
                ->paginate(6, pageName: 'tv-page'),
        ]);
    }
}

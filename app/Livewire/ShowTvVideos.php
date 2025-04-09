<?php

namespace App\Livewire;

use App\Enums\VideoType;
use App\Models\Video;
use App\Traits\VideoPopUp;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTvVideos extends Component
{
    use WithPagination, VideoPopUp;

    public function render()
    {
        return view('livewire.video-list', [
            'title' => __('videos.type.tv'),
            'videos' => Video::where('type', VideoType::TV)
                ->latest()
                ->paginate(6, pageName: 'tv-page')
        ]);
    }
}

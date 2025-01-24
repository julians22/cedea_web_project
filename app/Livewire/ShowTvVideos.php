<?php

namespace App\Livewire;

use App\Enums\VideoType;
use App\Models\Video;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTvVideos extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.video-list', [
            'title' => __('videos.type.tv'),
            'videos' => Video::where('type', VideoType::TV)
                ->paginate(6, pageName: 'tv-page')
        ]);
    }
}

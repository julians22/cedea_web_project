<?php

namespace App\Livewire;

use App\Enums\VideoType;
use App\Models\Video;
use App\Traits\VideoPopUp;
use Livewire\Component;
use Livewire\WithPagination;

class ShowRecipeVideos extends Component
{
    use WithPagination, VideoPopUp;

    public function render()
    {
        return view('livewire.video-list', [
            'title' => __('videos.type.recipe'),
            'videos' => Video::where('type', VideoType::RECIPE)
                ->latest()
                ->paginate(6, pageName: 'recipe-page')
        ]);
    }
}

<?php

namespace App\Livewire;

use App\Enums\VideoType;
use App\Models\Video;
use Livewire\Component;
use Livewire\WithPagination;

class ShowRecipeVideos extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.video-list', [
            'title' => __('videos.type.recipe'),
            'videos' => Video::where('type', VideoType::RECIPE)
                ->paginate(6, pageName: 'recipe-page')
        ]);
    }
}

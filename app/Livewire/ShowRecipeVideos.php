<?php

namespace App\Livewire;

use App\Enums\VideoType;
use App\Models\Video;
use App\Traits\VideoPopUp;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ShowRecipeVideos extends Component
{
    use VideoPopUp, WithPagination;

    public function mount(): void
    {
        $this->initializeVideoFromUrl();
    }

    protected function videoType(): VideoType
    {
        return VideoType::RECIPE;
    }

    public function render(): View
    {
        return view('livewire.video-list', [
            'title' => __('videos.type.recipe'),
            'videos' => Video::query()
                ->where('type', VideoType::RECIPE)
                ->latest()
                ->paginate(6, pageName: 'recipe-page'),
        ]);
    }
}

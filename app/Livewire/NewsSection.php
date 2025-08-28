<?php

namespace App\Livewire;

use App\Enums\NewsType;
use App\Models\PostNews;
use Livewire\Component;

class NewsSection extends Component
{
    public $currentType = 'all';

    public string $keyword = '';

    public function handleChangeType($type): void
    {
        if ($this->currentType == $type) {
            $this->reset('currentType');
        } else {
            if (! enum_exists(NewsType::class, $type)) {
                return;
            }
            $this->currentType = $type;
        }
    }

    // public function mount()
    // {
    //     $this->currentType = $this->types[0];
    // }

    public function render()
    {
        return view('livewire.news-section', [
            'news' => PostNews::with(['media', 'categories'])
                ->when(
                    $this->keyword,
                    function ($q) {
                        return $q->searchTranslated('title', $this->keyword, '*');
                    }
                )
                ->when(
                    $this->currentType !== 'all',
                    function ($q) {
                        return $q->where('type', $this->currentType);
                    }
                )
                ->where('published', 1)
                ->orderBy('published_at', 'desc')
                ->paginate(7),
        ]);
    }
}

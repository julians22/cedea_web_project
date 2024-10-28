<?php

namespace App\Livewire;

use App\Models\PostNews;
use Filament\Forms\Components\Builder;
use Livewire\Attributes\Url;
use Livewire\Component;

class NewsList extends Component
{
    public $types = [
        'activity' => 'Kegiatan',
        'article' => 'Artikel/blog',
    ];

    public $currentType;

    #[Url(except: '')]
    public string $keyword = '';

    public function handleChangeType($type): void
    {
        if (!array_key_exists($type, $this->types)) {
            return;
        }

        $this->currentType = $type;
    }

    public function mount()
    {
        $this->currentType = array_keys($this->types)[0] ?? null;
    }

    public function render()
    {


        return view('livewire.news-list', [
            'news' => PostNews::with(['media', 'categories'])
                ->when(
                    $this->keyword,
                    function ($q) {
                        return $q->searchTranslated('title', $this->keyword);
                    }
                )
                ->where('type', $this->currentType)
                ->orderBy('published_at', 'desc')
                ->paginate(6),
        ]);
    }
}

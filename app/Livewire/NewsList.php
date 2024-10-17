<?php

namespace App\Livewire;

use App\Models\PostNews;
use Filament\Forms\Components\Builder;
use Livewire\Attributes\Url;
use Livewire\Component;

class NewsList extends Component
{
    public $types = [
        'kegiatan',
        'artikel/blog',

    ];

    public $currentType;

    #[Url(except: '')]
    public string $keyword = '';

    public function handleChangeType($type): void
    {
        $this->currentType = $type;
    }

    public function mount()
    {
        $this->currentType = $this->types[0];
    }

    public function render()
    {
        return view('livewire.news-list', [
            'news' => PostNews::with(['media', 'categories'])
                ->when(
                    $this->keyword,
                    function ($q) {
                        return $q->whereRaw('LOWER(name) like "%' . strtolower($this->keyword) . '%"');
                    }
                )
                ->paginate(6),
        ]);
    }
}

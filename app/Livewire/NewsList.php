<?php

namespace App\Livewire;

use App\Enums\NewsType;
use App\Models\PostNews;
use Filament\Forms\Components\Builder;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class NewsList extends Component
{
    use WithPagination;

    #[Url(except: '', as: 'type', keep: true)]
    public $currentType = 'all';

    #[Url(except: '')]
    public string $keyword = '';

    public function handleChangeType($type): void
    {

        if ($this->currentType == $type) {
            $this->reset('currentType');
        } else {
            if (!enum_exists(NewsType::class, $type)) {
                return;
            }
            $this->currentType = $type;
        }
    }

    public function mount()
    {
        // $this->currentType = array_keys($this->types)[0] ?? null;
    }

    public function render()
    {


        return view('livewire.news-list', [
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
                ->orderBy('published_at', 'desc')
                ->paginate(6),
        ]);
    }
}

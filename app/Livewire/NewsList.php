<?php

namespace App\Livewire;

use Livewire\Component;

class NewsList extends Component
{
    public $types = ['kegiatan', 'artikel/blog'];
    public $currentType;

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
        return view('livewire.news-list');
    }
}

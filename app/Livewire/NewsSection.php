<?php

namespace App\Livewire;

use Livewire\Component;

class NewsSection extends Component
{
    public $types = ['Berita', 'Kreasi Resep'];
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

        return view('livewire.news-section');
    }
}

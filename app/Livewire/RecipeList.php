<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;

class RecipeList extends Component
{
    #[Url(except: '')]
    public string $keyword = '';

    public function render()
    {
        return view('livewire.recipe-list');
    }
}

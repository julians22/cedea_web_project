<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use Butschster\Head\Facades\Meta;

class RecipeList extends Component
{
    #[Url(except: '')]
    public string $keyword = '';

    #[Url(as: 'type', except: '')]
    public string $activeRecipeType = '';

    #[Url(as: 'product', except: '')]
    public string $activeProduct = '';

    public function mount()
    {
        Meta::prependTitle('Recipe');
    }

    function handleChangeActiveRecipeType(string $slug)
    {
        if ($this->activeRecipeType == $slug) {
            $this->reset('activeRecipeType');
        } else {
            $this->activeRecipeType = $slug;
        }
    }

    function handleChangeActiveProduct(string $slug)
    {
        if ($this->activeProduct == $slug) {
            $this->reset('activeProduct');
        } else {
            $this->activeProduct = $slug;
        }
    }

    public function render()
    {
        return view('livewire.recipe-list');
    }
}

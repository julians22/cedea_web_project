<?php

namespace App\Livewire;

use App\Models\PostRecipes;
use Livewire\Component;
use Livewire\Attributes\Url;
use Butschster\Head\Facades\Meta;
use Filament\Forms\Components\Builder;
use Livewire\WithPagination;

class RecipeList extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public string $keyword = '';

    #[Url(as: 'type', except: ['all', null, ''], keep: true)]
    public string $activeRecipeType = 'all';

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
        return view('livewire.recipe-list', [
            'recipes' => PostRecipes::with(['media', 'product'])
                ->when(
                    $this->activeProduct,
                    function ($q) {
                        return $q->whereRelation('product', 'slug', $this->activeProduct);
                    }
                )
                ->when(
                    $this->activeRecipeType !== 'all',
                    function ($q) {
                        return $q->where('recipe_type', $this->activeRecipeType);
                    }
                )
                ->orderby('created_at', 'desc')
                ->when(
                    $this->keyword,
                    function ($q) {
                        return $q->searchTranslated('title', $this->keyword, '*');
                    }
                )
                ->paginate(2),
        ]);
    }
}

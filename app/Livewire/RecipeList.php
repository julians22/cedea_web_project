<?php

namespace App\Livewire;

use App\Models\PostRecipes;
use Livewire\Component;
use Livewire\Attributes\Url;
use Butschster\Head\Facades\Meta;
use Filament\Forms\Components\Builder;

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
        return view('livewire.recipe-list', [
            'recipes' => PostRecipes::with(['media', 'product'])
                // ->when(
                //     $this->activeBrand,
                //     function ($q) {
                //         return $q->whereRelation('brand', 'slug', $this->activeBrand);
                //     }
                // )
                // ->when(
                //     $this->activeCategory !== 'all',
                //     function ($q) {
                //         return $q->whereHas('categories', function (Builder $query) {
                //             $query->where('slug', $this->activeCategory);
                //         });
                //     }
                // )
                // ->when(
                //     $this->keyword,
                //     function ($q) {
                //         return $q->whereRaw('LOWER(name) like "%' . strtolower($this->keyword) . '%"');
                //     }
                // )
                ->paginate(2),
        ]);
    }
}

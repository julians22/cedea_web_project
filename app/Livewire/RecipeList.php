<?php

namespace App\Livewire;

use App\Models\PostRecipes;
use App\Support\SeoMetadata;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class RecipeList extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public string $keyword = '';

    #[Url(as: 'type', except: ['all', null, ''])]
    public string $activeRecipeType = 'all';

    #[Url(as: 'product', except: '')]
    public string $activeProduct = '';

    public function mount(): void
    {
        SeoMetadata::register(
            title: __('seo.recipes.title'),
            description: __('seo.recipes.description'),
            url: route('recipe'),
            image: asset('img/mutu.jpg'),
        );
    }

    public function handleChangeActiveRecipeType(string $slug)
    {
        if ($this->activeRecipeType == $slug) {
            $this->reset('activeRecipeType');
        } else {
            $this->activeRecipeType = $slug;
        }
    }

    public function handleChangeActiveProduct(string $slug)
    {
        if ($this->activeProduct == $slug) {
            $this->reset('activeProduct');
        } else {
            $this->activeProduct = $slug;
        }
    }

    public function resetFilter(string $name)
    {
        $this->reset($name);
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
                ->when(
                    $this->keyword,
                    function ($q) {
                        return $q->searchTranslated('title', $this->keyword, '*');
                    }
                )
                ->where('published', 1)
                ->orderby('created_at', 'desc')
                ->paginate(2),
        ]);
    }
}

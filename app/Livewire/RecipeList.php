<?php

namespace App\Livewire;

use App\Models\PostRecipes;
use Livewire\Component;
use Livewire\Attributes\Url;
use Filament\Forms\Components\Builder;
use Livewire\WithPagination;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;

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

        if (app()->environment('production')) {
            // return redirect()->route('home');
            $this->redirect('/');
        }

        $og = new OpenGraphPackage('open graph');
        $twitter_card = new TwitterCardPackage('twitter');

        $title = 'Recipe - ' . env('APP_NAME');
        $description = 'Tinggalkan Pesan';
        $url = route('recipe');
        $image = asset('img/mutu.jpg');
        $locale = 'id_ID';
        $alternateLocale = 'en_US';

        Meta::setDescription($description);
        Meta::prependTitle('Recipe');

        $og
            ->setType('website')
            ->setSiteName(env('APP_NAME'))
            ->setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image)
            ->setLocale($locale)
            ->addAlternateLocale($alternateLocale);

        $twitter_card
            ->setTitle($title)
            ->setDescription($description)
            ->setImage($image);

        Meta::registerPackage($og);
        Meta::registerPackage($twitter_card);
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

    function resetFilter(string $name)
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

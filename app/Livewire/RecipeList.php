<?php

namespace App\Livewire;

use App\Models\PostRecipes;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Livewire\Attributes\Url;
use Livewire\Component;
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
        $og = new OpenGraphPackage('open graph');
        $twitter_card = new TwitterCardPackage('twitter');

        $title = 'Recipe - '.env('APP_NAME');
        $description = 'Menghadirkan kesegaran laut dalam setiap gigitan. Jelajahi kekayaan laut dengan rangkaian produk terbaik dari CEDEA Seafood! Mulai dari sarapan pagi hingga malam, temukan tips-tips kuliner yang memikat di setiap sajian.';
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

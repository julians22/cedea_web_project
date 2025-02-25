<?php

namespace App\Http\Controllers;

use App\Models\PostRecipes;
use Illuminate\Http\Request;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;

class RecipeController extends Controller
{

    public function show(PostRecipes $recipe)
    {
        $og = new OpenGraphPackage('open graph');
        $twitter_card = new TwitterCardPackage('twitter');

        $title = strip_tags((string) $recipe->title) . ' - ' . env('APP_NAME');
        $description = strip_tags((string) $recipe->description);
        $url = route('news.show', ['post' => $recipe->slug]);
        $image = $recipe->getFirstMediaUrl('featured_image');
        $locale = 'id_ID';
        $alternateLocale = 'en_US';

        Meta::setDescription($description);
        Meta::prependTitle(strip_tags((string)$recipe->title));

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


        return view(
            'recipe.show',
            compact('recipe')
        );
    }
}

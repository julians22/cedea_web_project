<?php

namespace App\Http\Controllers;

use App\Models\PostRecipes;
use App\Support\SeoMetadata;
use Illuminate\Contracts\View\View;

class RecipeController extends Controller
{
    public function show(PostRecipes $recipe): View
    {
        if (! $recipe->published) {
            abort(404);
        }

        SeoMetadata::register(
            title: (string) $recipe->title,
            description: (string) $recipe->description,
            url: route('recipe.show', ['recipe' => $recipe->slug]),
            image: $recipe->getFirstMediaUrl('featured_image') ?: asset('img/mutu.jpg'),
            type: 'article',
        );

        return view(
            'recipe.show',
            compact('recipe')
        );
    }
}

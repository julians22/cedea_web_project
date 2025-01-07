<?php

namespace App\Http\Controllers;

use App\Models\PostRecipes;
use Butschster\Head\Facades\Meta;
use Illuminate\Http\Request;

class RecipeController extends Controller
{

    public function show(PostRecipes $recipe)
    {
        Meta::prependTitle($recipe->title);

        if (app()->environment('production')) {
            return redirect()->route('home');
        }

        return view(
            'recipe.show',
            compact('recipe')
        );
    }
}

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

        return view(
            'recipe-detail',
            compact('recipe')
        );
    }
}

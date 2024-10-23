<?php

namespace App\Http\Controllers;

use App\Models\PostNews;
use App\Models\PostRecipes;
use App\Models\Products\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function __invoke(Request $request)
    {
        $query = $request->input('query');

        $news = PostNews::search('slug', $query)->searchTranslated('title', $query)->limit(3)->get();
        $recipes = PostRecipes::searchTranslated('title', $query)->limit(3)->get();
        $products = Product::searchTranslated('name', $query, "*")->limit(3)->get();

        return view('search', compact('recipes', 'news', 'products'));
    }
}

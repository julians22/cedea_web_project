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

        $news = PostNews::where(
            'title->' . app()->getLocale(),
            'LIKE',
            '%' . $query . '%'
        )->limit(3)->get();;

        $recipes = PostRecipes::where(
            'title->' . app()->getLocale(),
            'LIKE',
            '%' . $query . '%'
        )->limit(3)->get();;
        $product = Product::where('name->' . app()->getLocale(), 'LIKE', '%' . $query . '%')->limit(3)->get();;


        return view('search', compact('recipes', 'news', 'product'));
    }
}

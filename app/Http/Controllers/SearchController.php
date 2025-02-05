<?php

namespace App\Http\Controllers;

use App\Models\PostNews;
use App\Models\PostRecipes;
use App\Models\Products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SearchController extends Controller
{

    public function __invoke(Request $request)
    {

        $routeList = [
            'home',
            'about',
            'product',
            'recipe',
            'news',
            'contact',
            'marketplace',
            'videos',
        ];

        // Determine the language to use based on the request input
        // If the requested language is supported, use it; otherwise, use the default '*'
        $lang = array_key_exists($request->input('lang'), LaravelLocalization::getSupportedLocales())
            ? $request->input('lang')
            : '*';

        $query = $request->input('query');

        $news = PostNews::search('slug', $query)->searchTranslated('title', $query, $lang)->limit(3)->with(['media'])->get();
        $recipes = PostRecipes::searchTranslated('title', $query, $lang)->limit(3)->with(['media'])->get();
        $products = Product::searchTranslated('name', $query, $lang)->limit(3)->with(['media', 'brand'])->get();

        return view('search', compact('recipes', 'news', 'products', 'lang'));
    }
}

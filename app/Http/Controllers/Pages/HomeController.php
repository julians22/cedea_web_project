<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\PostNews;
use App\Models\PostRecipes;
use App\Models\Products\Brand;
use App\Models\Products\Category;
use Butschster\Head\Facades\Meta;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class HomeController extends Controller
{
    function index()
    {
        Meta::prependTitle('Home');

        $brands = Brand::orderBy('order_column')->get();
        $articles = PostNews::with('media')->where('is_publish', true)->take(2)->get();
        $recipes = PostRecipes::with('media')->where('is_publish', true)->take(2)->get();
        return view('welcome', compact('articles', 'recipes', 'brands'));
    }

    function product()
    {
        Meta::prependTitle('PRODUCT');

        return view('merek');
    }

    function contact()
    {
        return view('contact');
    }
}

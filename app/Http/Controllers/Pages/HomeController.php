<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\PostNews;
use App\Models\PostRecipes;
use App\Models\Products\Category;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class HomeController extends Controller
{
    function index()
    {
        $categories = Category::all();
        $articles = PostNews::with('media')->where('is_publish', true)->take(2)->get();
        $recipes = PostRecipes::with('media')->where('is_publish', true)->take(2)->get();
        return view('welcome', compact('articles', 'recipes', 'categories'));
    }

    function product()
    {
        $categories = Category::with('myMediaRelation')->get();
        $tags = Tag::all();

        return view('product', compact('categories', 'tags'));
    }

    function contact()
    {
        return view('contact');
    }
}

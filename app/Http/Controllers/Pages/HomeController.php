<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Banner;
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

        $banners = Banner::with('media')->orderBy('order_column')->where('enable', true)->get();

        // $brands = Brand::orderBy('order_column')->get();
        // $articles = PostNews::with('media')->where('published', true)->take(2)->get();
        // $recipes = PostRecipes::with('media')->where('published', true)->take(2)->get();
        return view('welcome', compact('banners'));
    }

    function product()
    {
        Meta::prependTitle('PRODUCT');

        return view('product');
    }

    function contact()
    {
        return view('contact');
    }
}

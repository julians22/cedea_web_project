<?php

use Embed\Embed;
use Butschster\Head\Facades\Meta;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\HomeController;
use App\Livewire\Frontend\ProductList;
use App\Livewire\RecipeList;
use App\Models\PostRecipes;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get(
    'about',
    function () {
        Meta::prependTitle('TENTANG CEDEA');

        return view('about');
    }
)
    ->name('about');

Route::get(
    'product',
    ProductList::class
)
    ->name('product');

Route::get(
    'recipe',
    RecipeList::class
)
    ->name('recipe');

Route::view('recipe/detail', 'recipe-detail')
    ->name('recipe.detail');

Route::get('contact', [HomeController::class, 'contact'])
    ->name('contact');

Route::get('video_get', function () {
    $recipe = PostRecipes::first();

    return $recipe->ingredients;

    $embed = new Embed();

    //Load any url:
    $info = $embed->get('https://www.youtube.com/watch?v=W9cAe7SUTyo');
    // return $info->image;
    dd($info);
});

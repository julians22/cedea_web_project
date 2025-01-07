<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\NewsController;
use Embed\Embed;
use Butschster\Head\Facades\Meta;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SearchController;
use App\Livewire\Contact;
use App\Livewire\Frontend\ProductList;
use App\Livewire\RecipeList;
use App\Models\PostNews;
use App\Models\PostRecipes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/', HomeController::class)
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


    Route::get('recipe/{recipe}', [RecipeController::class, 'show'])
        ->name('recipe.detail');

    Route::get(
        'news',
        [NewsController::class, 'create']
    )->name('news');

    Route::get(
        'news/{post}',
        [NewsController::class, 'show']
    )->name('news.show');

    // Route::get('contact', Contact::class)
    //     ->name('contact');

    // Route::get('marketplace', MarketplaceController::class)
    //     ->name('marketplace');

    Route::get('search', SearchController::class)
        ->name('search');


    // Route::get('video_get', function () {

    //     $embed = new Embed();

    //     //Load any url:
    //     $info = $embed->get('https://www.youtube.com/watch?v=W9cAe7SUTyo');
    //     // return $info->image;
    //     dd($info);
    // });
});

Route::post('locale-switcher', [LocaleController::class, 'localeSwitch'])
    ->name('locale.switch');

/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/

<?php

use Embed\Embed;
use Butschster\Head\Facades\Meta;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\HomeController;

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

Route::get('product', [HomeController::class, 'product'])
    ->name('product');

Route::get(
    'recipe',
    function () {
        Meta::prependTitle('TENTANG CEDEA');

        return view('about');
    }
)
    ->name('recipe');

Route::get('contact', [HomeController::class, 'contact'])
    ->name('contact');

Route::get('video_get', function () {
    $embed = new Embed();

    //Load any url:
    $info = $embed->get('https://www.youtube.com/watch?v=W9cAe7SUTyo');
    // return $info->image;
    dd($info);
});

<?php

use Alaouy\Youtube\Facades\Youtube;
use App\Http\Controllers\Pages\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('about', function () {
    return view('about');
})
->name('about');

Route::get('product', [HomeController::class, 'product'])->name('product');

Route::get('contact', [HomeController::class, 'contact'])->name('contact');

Route::get('video_get', function () {
    $video = Youtube::getVideoInfo('W9cAe7SUTyo');

    dd($video);
});

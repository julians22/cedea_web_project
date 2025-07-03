<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VideoController;
use App\Livewire\Contact;
use App\Livewire\Frontend\ProductList;
use App\Livewire\RecipeList;
use App\Mail\ContactMail;
use App\Models\Message;
use Embed\Embed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
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
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::get('/', HomeController::class)
        ->name('home');

    Route::get('about', AboutController::class)
        ->name('about');

    Route::get('product', ProductList::class)
        ->name('product');

    Route::get('recipe', RecipeList::class)
        ->name('recipe');

    Route::get('recipe/{recipe}', [RecipeController::class, 'show'])
        ->name('recipe.show');

    Route::get(
        'news',
        [NewsController::class, 'index']
    )->name('news');

    Route::get(
        'news/{post}',
        [NewsController::class, 'show']
    )->name('news.show');

    Route::get('contact', Contact::class)
        ->name('contact');

    Route::get('marketplace', MarketplaceController::class)
        ->name('marketplace');

    Route::get('videos', [VideoController::class, 'index'])
        ->name('videos');

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

if (app()->environment('local')) {
    Route::get('/preview/email', function () {

        $mockMessage = new Message([
            'name' => 'Ghassan Fadhlillah Sururi',
            'email' => 'fsghassan2429d@gmail.com',
            'subject' => 'test ajadsad',
            'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sed dui. Mauris ut justo. Sed dolor nunc, pretium vel, scelerisque ac, condimentum ut, nulla. Mauris vitae pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed non lectus. Integer non velit. Donec ac eros. Nullam euismod, justo at cursus venenatis, nibh nisl viverra ipsum, nec imperdiet sem ipsum in sapien.',
            'type' => 'inquiry',
            'address' => 'Jl. agung raya 1 gg turi 2 lenteng agung',
            'phone' => '082311354631',
            'city' => 'Jakarta',
            'gender' => 'male',
            'age' => '12-16',
            'institution' => null,
            'visitor_size' => null,
            'proposed_date' => null,
            'purpose' => 'product_inquiry',
        ]);

        // The email sending is done using the to method on the Mail facade
        // Mail::to(env('MAIL_TO_ADDRESS'))->send(new ContactMail($mockMessage));

        return new App\Mail\ContactMail($mockMessage);
    });
}

Route::post('locale-switcher', [LocaleController::class, 'localeSwitch'])
    ->name('locale.switch');

/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/

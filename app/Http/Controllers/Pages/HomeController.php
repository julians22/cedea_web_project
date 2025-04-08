<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\PostNews;
use App\Models\PostRecipes;
use App\Models\Products\Brand;
use App\Models\Products\Category;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class HomeController extends Controller
{
    function __invoke()
    {
        $banners = Banner::with('media')->orderBy('order_column')->where('enable', true)->get();

        $og = new OpenGraphPackage('open graph');
        $twitter_card = new TwitterCardPackage('twitter');

        $title = 'Home - ' . env('APP_NAME');
        $description = 'CEDEA SEAFOOD diproduksi oleh PT CitraDimensi Arthali yang berkomitmen untuk terus menghasilkan makanan beku dari ikan olahan terbaik dengan penerapan GMP, HACCP, ISO 22000, BPOM, Halal.';
        $url = route('home');
        $image = $banners->first()?->getFirstMediaUrl('banner_desktop') ?? asset('img/mutu.jpg');
        $locale = 'id_ID';
        $alternateLocale = 'en_US';

        Meta::setDescription($description);
        Meta::prependTitle('Home');

        $og
            ->setType('website')
            ->setSiteName(env('APP_NAME'))
            ->setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image)
            ->setLocale($locale)
            ->addAlternateLocale($alternateLocale);

        $twitter_card
            ->setTitle($title)
            ->setDescription($description)
            ->setImage($image);

        Meta::registerPackage($og);
        Meta::registerPackage($twitter_card);

        // Or just register this package in Meta class and it will be rendered automatically


        // $brands = Brand::orderBy('order_column')->get();
        // $articles = PostNews::with('media')->where('published', true)->take(2)->get();
        // $recipes = PostRecipes::with('media')->where('published', true)->take(2)->get();
        return view('welcome', compact('banners'));
    }
}

<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\PostNews;
use App\Models\PostRecipes;
use App\Models\Products\Brand;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;

class HomeController extends Controller
{
    public function __invoke()
    {
        $banners = Banner::with('media')->orderBy('order_column')->where('enable', true)->get();

        $og = new OpenGraphPackage('open graph');
        $twitter_card = new TwitterCardPackage('twitter');

        $title = 'Home - '.env('APP_NAME');
        $description = 'Nikmati olahan ikan segar dengan frozen food halal dari Cedea Seafood. Produk berkualitas tinggi untuk sajian praktis dan lezat setiap hari.';
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

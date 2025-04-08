<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Embed\Embed;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;

class VideoController extends Controller
{
    public function index()
    {
        $og = new OpenGraphPackage('open graph');
        $twitter_card = new TwitterCardPackage('twitter');

        $title = 'Videos - ' . env('APP_NAME');
        $description = 'Tonton video lengkap Cedea Seafood di kanal YouTube kami! Temukan resep kreatif, tips memasak, dan cerita inspiratif di balik produk hasil laut berkualitas tinggi kami.';
        $url = route('videos');
        $image = asset('img/mutu.jpg');
        $locale = 'id_ID';
        $alternateLocale = 'en_US';

        Meta::setDescription($description);
        Meta::prependTitle('Videos');

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

        return view('videos');
    }
}

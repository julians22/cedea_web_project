<?php

namespace App\Http\Controllers;

use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $og = new OpenGraphPackage('open graph');
        $twitter_card = new TwitterCardPackage('twitter');

        $title = 'TENTANG CEDEA - '.env('APP_NAME');
        $description = 'PT CitraDimensi Arthali merupakan salah satu perusahaan di Indonesia yang bergerak di bidang pengolahan hasil perikanan dan manufaktur frozen seafood dengan brand CEDEA yang berlokasi di Muara Baru, Majalengka, Medan & Semarang.';
        $url = route('about');
        $image = asset('img/mutu.jpg');
        $locale = 'id_ID';
        $alternateLocale = 'en_US';

        Meta::setDescription($description);
        Meta::prependTitle('About');

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

        return view('about');
    }
}

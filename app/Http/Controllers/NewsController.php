<?php

namespace App\Http\Controllers;

use App\Models\PostNews;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;

class NewsController extends Controller
{
    public function index()
    {
        $og = new OpenGraphPackage('open graph');
        $twitter_card = new TwitterCardPackage('twitter');

        $title = 'News - '.env('APP_NAME');
        $description = 'Temukan berita terbaru dan update kegiatan perusahaan kami di sini. Ikuti perkembangan terbaru dan berita penting dari CEDEA Seafood.';
        $url = config('app.env') === 'production' ? 'https://cedeaseafood.com' : 'https://cedea.democube.id';
        $image = asset('img/mutu.jpg');
        $locale = 'id_ID';
        $alternateLocale = 'en_US';

        Meta::setDescription($description);
        Meta::prependTitle('News');

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

        $banners = PostNews::where('published', 1)->orderBy('published_at', 'desc')->take(3)->get();

        return view('news', compact(
            'banners'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(PostNews $post)
    {

        if (! $post->published) {
            abort(404);
        }

        $og = new OpenGraphPackage('open graph');
        $twitter_card = new TwitterCardPackage('twitter');

        $title = strip_tags((string) $post->title).' - '.env('APP_NAME');
        $description = strip_tags($post->excerpt);
        $url = route('news.show', ['post' => $post->slug]);
        $image = $post->getFirstMediaUrl('featured_image');
        $locale = 'id_ID';
        $alternateLocale = 'en_US';

        Meta::setDescription($description);
        Meta::prependTitle(strip_tags((string) $post->title))
            ->setCanonical(env('APP_URL').'/news/'.$post->slug);

        $og
            ->setType('website')
            ->setSiteName(env('APP_NAME'))
            ->setTitle($title)
            ->setDescription($description)
            ->setUrl(env('APP_URL').'/news/'.$post->slug)
            ->addImage($image)
            ->setLocale($locale)
            ->addAlternateLocale($alternateLocale);

        $twitter_card
            ->setTitle($title)
            ->setDescription($description)
            ->setImage($image);

        Meta::registerPackage($og);
        Meta::registerPackage($twitter_card);

        return view('news.show', compact('post'));
    }
}

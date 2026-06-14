<?php

namespace App\Http\Controllers;

use App\Models\PostNews;
use App\Support\SeoMetadata;
use Illuminate\Contracts\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        SeoMetadata::register(
            title: __('seo.news.title'),
            description: __('seo.news.description'),
            url: route('news'),
            image: asset('img/mutu.jpg'),
        );

        $banners = PostNews::where('published', 1)->orderBy('published_at', 'desc')->take(3)->get();

        return view('news', compact(
            'banners'
        ));
    }

    public function show(PostNews $post): View
    {
        if (! $post->published) {
            abort(404);
        }

        SeoMetadata::register(
            title: (string) $post->title,
            description: (string) $post->excerpt,
            url: route('news.show', ['post' => $post->slug]),
            image: $post->getFirstMediaUrl('featured_image') ?: asset('img/mutu.jpg'),
            type: 'article',
        );

        return view('news.show', compact('post'));
    }
}

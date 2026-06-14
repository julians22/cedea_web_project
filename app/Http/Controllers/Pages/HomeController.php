<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Support\SeoMetadata;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $banners = Banner::with('media')->orderBy('order_column')->where('enable', true)->get();

        $image = $banners->first()?->getFirstMediaUrl('banner_desktop') ?? asset('img/mutu.jpg');

        SeoMetadata::register(
            title: __('seo.home.title'),
            description: __('seo.home.description'),
            url: route('home'),
            image: $image,
        );

        return view('welcome', compact('banners'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Support\SeoMetadata;
use Illuminate\Contracts\View\View;

class AboutController extends Controller
{
    public function __invoke(): View
    {
        SeoMetadata::register(
            title: __('seo.about.title'),
            description: __('seo.about.description'),
            url: route('about'),
            image: asset('img/mutu.jpg'),
        );

        return view('about');
    }
}

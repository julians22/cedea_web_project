<?php

namespace App\Http\Controllers;

use App\Support\SeoMetadata;
use Illuminate\Contracts\View\View;

class VideoController extends Controller
{
    public function index(): View
    {
        SeoMetadata::register(
            title: __('seo.videos.title'),
            description: __('seo.videos.description'),
            url: route('videos'),
            image: asset('img/mutu.jpg'),
        );

        return view('videos');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Support\SeoMetadata;
use Illuminate\Contracts\View\View;

class VideoController extends Controller
{
    public function index(): View
    {
        $video = Video::query()
            ->with('media')
            ->where('slug', request()->string('video')->toString())
            ->first();
        $title = trim(strip_tags((string) $video?->title));
        $description = trim(strip_tags((string) $video?->description));

        SeoMetadata::register(
            title: $title ?: __('seo.videos.title'),
            description: $description ?: __('seo.videos.description'),
            url: route('videos', array_filter(['video' => $video?->slug])),
            image: $video?->thumbnail ?: asset('img/mutu.jpg'),
            type: $video ? 'video.other' : 'website',
        );

        return view('videos');
    }
}

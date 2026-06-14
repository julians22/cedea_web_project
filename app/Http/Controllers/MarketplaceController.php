<?php

namespace App\Http\Controllers;

use App\Support\SeoMetadata;
use Illuminate\Contracts\View\View;

class MarketplaceController extends Controller
{
    public function __invoke(): View
    {
        SeoMetadata::register(
            title: __('seo.marketplace.title'),
            description: __('seo.marketplace.description'),
            url: route('marketplace'),
            image: asset('img/marketplace/header.jpg'),
        );

        return view('marketplace');
    }
}

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
            structuredData: $this->structuredData($image),
        );

        return view('welcome', compact('banners'));
    }

    /**
     * @return array<string, mixed>
     */
    private function structuredData(string $image): array
    {
        $homeUrl = route('home');
        $logoUrl = asset('img/logo-cedea.png');

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Organization',
                    '@id' => "{$homeUrl}#organization",
                    'name' => 'CEDEA Seafood',
                    'legalName' => 'PT CitraDimensi Arthali',
                    'url' => $homeUrl,
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => $logoUrl,
                    ],
                    'image' => $image,
                    'description' => __('seo.home.description'),
                    'sameAs' => [
                        'https://www.facebook.com/CedeaSeafood',
                        'https://www.instagram.com/cedeaseafood',
                        'https://www.tiktok.com/@cedeaseafoodofficial',
                        'https://www.youtube.com/c/cedeaseafood',
                        'https://id.linkedin.com/company/pt-citradimensi-arthali',
                    ],
                ],
                [
                    '@type' => 'LocalBusiness',
                    '@id' => "{$homeUrl}#local-business",
                    'name' => 'PT CitraDimensi Arthali',
                    'url' => $homeUrl,
                    'image' => $image,
                    'telephone' => '+62-21-3020-3333',
                    'email' => 'info@cedeaseafood.com',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => 'Sudirman 7.8, Lt. 20, Unit 01, Jl. Jend. Sudirman Kav. 7-8',
                        'addressLocality' => 'Jakarta Pusat',
                        'postalCode' => '10220',
                        'addressCountry' => 'ID',
                    ],
                    'parentOrganization' => [
                        '@id' => "{$homeUrl}#organization",
                    ],
                ],
                [
                    '@type' => 'WebSite',
                    '@id' => "{$homeUrl}#website",
                    'name' => 'CEDEA Seafood',
                    'url' => $homeUrl,
                    'publisher' => [
                        '@id' => "{$homeUrl}#organization",
                    ],
                    'inLanguage' => str_replace('_', '-', app()->getLocale()),
                ],
            ],
        ];
    }
}

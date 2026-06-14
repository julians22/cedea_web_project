<?php

namespace App\Support;

use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;

final class SeoMetadata
{
    public static function register(
        string $title,
        string $description,
        string $url,
        string $image,
        string $type = 'website',
    ): void {
        $title = trim(strip_tags($title));
        $description = trim(strip_tags($description));
        $siteName = (string) config('app.name');
        $fullTitle = "{$title} - {$siteName}";

        Meta::setTitle($fullTitle);
        Meta::setDescription($description);

        $openGraph = (new OpenGraphPackage('open graph'))
            ->setType($type)
            ->setSiteName($siteName)
            ->setTitle($fullTitle)
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image)
            ->setLocale(self::openGraphLocale(app()->getLocale()));

        foreach (config('localizer.supported_locales', []) as $locale) {
            if ($locale !== app()->getLocale()) {
                $openGraph->addAlternateLocale(self::openGraphLocale($locale));
            }
        }

        $twitterCard = (new TwitterCardPackage('twitter'))
            ->setTitle($fullTitle)
            ->setDescription($description)
            ->setImage($image);

        Meta::replacePackage($openGraph);
        Meta::replacePackage($twitterCard);
    }

    private static function openGraphLocale(string $locale): string
    {
        return match ($locale) {
            'id' => 'id_ID',
            'en' => 'en_US',
            default => str_replace('-', '_', $locale),
        };
    }
}

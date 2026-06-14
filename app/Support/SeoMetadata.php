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
            ->setLocale(Localization::openGraphLocale(app()->getLocale()));

        foreach (Localization::locales() as $locale) {
            if ($locale !== app()->getLocale()) {
                $openGraph->addAlternateLocale(Localization::openGraphLocale($locale));
            }
        }

        $twitterCard = (new TwitterCardPackage('twitter'))
            ->setTitle($fullTitle)
            ->setDescription($description)
            ->setImage($image);

        Meta::replacePackage($openGraph);
        Meta::replacePackage($twitterCard);
    }
}

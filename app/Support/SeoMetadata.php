<?php

namespace App\Support;

use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;

final class SeoMetadata
{
    /**
     * @var array<string, mixed>|null
     */
    private static ?array $structuredData = null;

    /**
     * @param  array<string, mixed>|null  $structuredData
     */
    public static function register(
        string $title,
        string $description,
        string $url,
        string $image,
        string $type = 'website',
        ?array $structuredData = null,
    ): void {
        $title = trim(strip_tags($title));
        $description = trim(strip_tags($description));
        $siteName = (string) config('app.name');
        $fullTitle = "{$title} - {$siteName}";
        self::$structuredData = $structuredData;

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

    public static function structuredData(): ?string
    {
        if (self::$structuredData === null) {
            return null;
        }

        $json = json_encode(
            self::$structuredData,
            JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
        );

        return $json === false ? null : $json;
    }
}

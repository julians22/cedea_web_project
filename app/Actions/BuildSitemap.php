<?php

namespace App\Actions;

use App\Models\PostNews;
use App\Models\PostRecipes;
use App\Models\Products\Product;
use Illuminate\Support\Carbon;
use NielsNumbers\LaravelLocalizer\Facades\Localizer;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class BuildSitemap
{
    private const SITEMAP_FILES = [
        'pages' => 'sitemap_pages.xml',
        'products' => 'sitemap_products.xml',
        'news' => 'sitemap_news.xml',
        'recipes' => 'sitemap_recipes.xml',
    ];

    /**
     * Build the sitemap.
     */
    public function build(): void
    {
        $sitemaps = [
            'pages' => $this->buildPagesSitemap(),
            'products' => $this->buildProductsSitemap(),
            'news' => $this->buildNewsSitemap(),
            'recipes' => $this->buildRecipesSitemap(),
        ];

        $index = SitemapIndex::create();

        foreach ($sitemaps as $type => $sitemap) {
            $filename = self::SITEMAP_FILES[$type];

            $sitemap->writeToFile(public_path($filename));
            $index->add(url($filename));
        }

        $index->writeToFile(public_path('sitemap.xml'));
    }

    private function buildPagesSitemap(): Sitemap
    {
        $sitemap = Sitemap::create();
        $staticRoutes = [
            ['home', Url::CHANGE_FREQUENCY_YEARLY, 1.0],
            ['about', Url::CHANGE_FREQUENCY_YEARLY, 0.8],
            ['product', Url::CHANGE_FREQUENCY_MONTHLY, 0.9],
            ['videos', Url::CHANGE_FREQUENCY_MONTHLY, 0.7],
            ['marketplace', Url::CHANGE_FREQUENCY_YEARLY, 0.7],
            ['recipe', Url::CHANGE_FREQUENCY_MONTHLY, 0.8],
            ['news', Url::CHANGE_FREQUENCY_MONTHLY, 0.8],
            ['contact', Url::CHANGE_FREQUENCY_YEARLY, 0.5],
        ];

        foreach ($staticRoutes as [$routeName, $changeFrequency, $priority]) {
            $this->addLocalizedRoute($sitemap, $routeName, [], null, $changeFrequency, $priority);
        }

        return $sitemap;
    }

    private function buildProductsSitemap(): Sitemap
    {
        $sitemap = Sitemap::create();

        Product::query()
            ->eachById(fn (Product $product) => $this->addLocalizedRoute(
                $sitemap,
                'product',
                ['product' => $product->slug],
                $product->updated_at,
                Url::CHANGE_FREQUENCY_MONTHLY,
                0.7,
            ));

        return $sitemap;
    }

    private function buildNewsSitemap(): Sitemap
    {
        $sitemap = Sitemap::create();

        PostNews::query()
            ->where('published', true)
            ->eachById(fn (PostNews $post) => $this->addLocalizedRoute(
                $sitemap,
                'news.show',
                ['post' => $post->slug],
                $post->updated_at,
                Url::CHANGE_FREQUENCY_YEARLY,
                0.7,
            ));

        return $sitemap;
    }

    private function buildRecipesSitemap(): Sitemap
    {
        $sitemap = Sitemap::create();

        PostRecipes::query()
            ->where('published', true)
            ->eachById(fn (PostRecipes $recipe) => $this->addLocalizedRoute(
                $sitemap,
                'recipe.show',
                ['recipe' => $recipe->slug],
                $recipe->updated_at,
                Url::CHANGE_FREQUENCY_YEARLY,
                0.7,
            ));

        return $sitemap;
    }

    /**
     * Add every localized variant and its hreflang alternates.
     */
    private function addLocalizedRoute(
        Sitemap $sitemap,
        string $routeName,
        array $parameters = [],
        ?Carbon $lastModified = null,
        string $changeFrequency = Url::CHANGE_FREQUENCY_MONTHLY,
        float $priority = 0.8,
    ): void {
        $defaultLocale = Localizer::defaultLocale();
        $hideDefaultLocale = Localizer::hideDefaultLocale();
        $localizedUrls = collect(Localizer::supportedLocales())
            ->mapWithKeys(fn (string $locale) => [
                $locale => $locale === $defaultLocale && $hideDefaultLocale
                    ? route("without_locale.{$routeName}", $parameters)
                    : route($routeName, [...$parameters, 'locale' => $locale]),
            ]);

        foreach ($localizedUrls as $url) {
            $tag = Url::create($url)
                ->setChangeFrequency($changeFrequency)
                ->setPriority($priority);

            if ($lastModified) {
                $tag->setLastModificationDate($lastModified);
            }

            foreach ($localizedUrls as $alternateLocale => $alternateUrl) {
                $tag->addAlternate($alternateUrl, $alternateLocale);
            }

            if ($defaultUrl = $localizedUrls->get($defaultLocale)) {
                $tag->addAlternate($defaultUrl, 'x-default');
            }

            $sitemap->add($tag);
        }
    }
}

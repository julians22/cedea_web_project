<?php

namespace App\Http\Controllers;

use App\Models\PostNews;
use App\Models\PostRecipes;
use App\Models\Products\Product;
use App\Support\SeoMetadata;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use NielsNumbers\LaravelLocalizer\Facades\Localizer;

class SearchController extends Controller
{
    private const RESULT_LIMIT = 3;

    private function scrapePageContent(string $url): string
    {
        try {
            $response = Http::withOptions([
                'verify' => ! app()->environment('local'),
            ])
                ->connectTimeout(1)
                ->timeout(3)
                ->get($url);
        } catch (ConnectionException) {
            return '';
        }

        if (! $response->successful()) {
            return '';
        }

        $html_content = $response->body();

        $html_content = preg_replace('/<(header|footer|nav|script|style)\b[^>]*>.*?<\/\1>/is', '', $html_content);
        $html_content = html_entity_decode(strip_tags($html_content), ENT_QUOTES | ENT_HTML5);

        return trim(preg_replace('/\s+/', ' ', $html_content));
    }

    private function scrapeRoutesAndFind(array $locales, string $keyword): array
    {
        $scrapeResults = [];

        $routeNames = [
            'home',
            'about',
            'contact',
            'marketplace',
        ];

        foreach ($routeNames as $name) {
            foreach ($locales as $locale) {
                $localizedRoute = route($name, ['locale' => $locale]);
                $cacheKey = "search-page-content:{$locale}:{$name}";
                $content = Cache::get($cacheKey);

                if ($content === null) {
                    $content = $this->scrapePageContent($localizedRoute);

                    if ($content !== '') {
                        Cache::put($cacheKey, $content, now()->addMinutes(15));
                    }
                }

                if (stripos($content, $keyword) !== false) {
                    $scrapeResults[$name] = $localizedRoute;

                    break;
                }
            }
        }

        return $scrapeResults;
    }

    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'query' => ['nullable', 'string', 'max:100'],
            'lang' => ['nullable', 'string', 'max:10'],
        ]);

        $query = trim($validated['query'] ?? '');
        $lang = Localizer::isSupported($validated['lang'] ?? null)
            ? $validated['lang']
            : '*';
        $locales = $lang === '*' ? Localizer::supportedLocales() : [$lang];
        $resultLocale = $lang === '*' ? app()->getLocale() : $lang;
        $scrape_results = $query === ''
            ? []
            : $this->scrapeRoutesAndFind($locales, $query);

        $safeQuery = strip_tags($query);
        $title = $query !== ''
            ? __('seo.search.title_with_query', ['query' => $safeQuery])
            : __('seo.search.title');
        $description = $query !== ''
            ? __('seo.search.description_with_query', ['query' => $safeQuery])
            : __('seo.search.description');
        $url = route('search', array_filter([
            'query' => $query,
            'lang' => $lang !== '*' ? $lang : null,
        ]));

        SeoMetadata::register(
            title: $title,
            description: $description,
            url: $url,
            image: asset('img/mutu.jpg'),
        );

        $news = collect();
        $recipes = collect();
        $products = collect();

        if ($query !== '') {
            $news = PostNews::query()
                ->where('published', true)
                ->where(function (Builder $searchQuery) use ($query, $lang): void {
                    $searchQuery
                        ->search('slug', $query)
                        ->orWhere(fn (Builder $titleQuery) => $titleQuery->searchTranslated(
                            'title',
                            $query,
                            $lang,
                        ));
                })
                ->with([
                    'media' => fn ($mediaQuery) => $mediaQuery->where('collection_name', 'featured_image'),
                ])
                ->orderByDesc('published_at')
                ->limit(self::RESULT_LIMIT + 1)
                ->get();

            $recipes = PostRecipes::query()
                ->where('published', true)
                ->searchTranslated('title', $query, $lang)
                ->with([
                    'media' => fn ($mediaQuery) => $mediaQuery->where('collection_name', 'featured_image'),
                ])
                ->latest()
                ->limit(self::RESULT_LIMIT + 1)
                ->get();

            $products = Product::query()
                ->searchTranslated('name', $query, $lang)
                ->with([
                    'media' => fn ($mediaQuery) => $mediaQuery->where('collection_name', 'packaging'),
                    'brand:id,slug',
                ])
                ->orderBy('order_column')
                ->limit(self::RESULT_LIMIT + 1)
                ->get();
        }

        $hasMoreNews = $news->count() > self::RESULT_LIMIT;
        $hasMoreRecipes = $recipes->count() > self::RESULT_LIMIT;
        $hasMoreProducts = $products->count() > self::RESULT_LIMIT;

        $news = $news->take(self::RESULT_LIMIT);
        $recipes = $recipes->take(self::RESULT_LIMIT);
        $products = $products->take(self::RESULT_LIMIT);

        return view('search', compact(
            'recipes',
            'news',
            'products',
            'scrape_results',
            'lang',
            'query',
            'hasMoreNews',
            'hasMoreRecipes',
            'hasMoreProducts',
            'resultLocale',
        ));
    }
}

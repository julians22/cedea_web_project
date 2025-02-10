<?php

namespace App\Http\Controllers;

use App\Models\PostNews;
use App\Models\PostRecipes;
use App\Models\Products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\LaravelLocalization as LaravelLocalizationLaravelLocalization;
use Symfony\Component\DomCrawler\Crawler;

class SearchController extends Controller
{

    private function scrapePageContent($url)
    {
        $response = Http::get($url);
        $html_content = $response->getBody()->getContents();

        $crawler = new Crawler($html_content);

        // Extract specific text using XPath or CSS selector
        $title = $crawler->filter('title')->text();
        // Remove <script> tags and their contents from the HTML content
        $html_content = preg_replace('/<script.*?>.*?<\/script>/s', '', $html_content);
        // Remove <style> tags and their contents from the HTML content
        $html_content = preg_replace('/<style.*?>.*?<\/style>/s', '', $html_content);
        $html_content = strip_tags($html_content);
        $crawler = new Crawler($html_content);
        $articleText = $crawler->filter('body')->text();

        return $articleText;
    }

    private function scrapeRoutesAndFind($lang, $keyword)
    {
        $scrape_results = [];

        $route_name_list = [
            'home',
            'about',
            'contact',
            'marketplace',
        ];

        foreach ($route_name_list as $name) {
            $locales = ($lang === '*') ? LaravelLocalization::getSupportedLanguagesKeys() : [$lang];
            foreach ($locales as $locale) {
                $route = route($name);
                if (!array_key_exists($name, $scrape_results)) {
                    $result = $this->scrapePageContent(LaravelLocalization::getLocalizedURL($locale, $route));
                    if (stripos($result, $keyword) !== false) {
                        $scrape_results = array_merge($scrape_results, [$name => $route]);
                    }
                }
            }
        }

        return $scrape_results;
    }


    public function __invoke(Request $request)
    {
        // Determine the language to use based on the request input
        // If the requested language is supported, use it; otherwise, use the default '*'
        $lang = array_key_exists($request->input('lang'), LaravelLocalization::getSupportedLocales())
            ? $request->input('lang')
            : '*';

        $query = $request->input('query');
        $scrape_results = $this->scrapeRoutesAndFind($lang, $query);

        $news = PostNews::search('slug', $query)->searchTranslated('title', $query, $lang)->limit(3)->with(['media'])->get();
        $recipes = PostRecipes::searchTranslated('title', $query, $lang)->limit(3)->with(['media'])->get();
        $products = Product::searchTranslated('name', $query, $lang)->limit(3)->with(['media', 'brand'])->get();

        return view('search', compact('recipes', 'news', 'products', 'scrape_results', 'lang'));
    }
}

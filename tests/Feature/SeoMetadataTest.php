<?php

use App\Actions\BuildSitemap;
use App\Models\PostNews;
use App\Models\PostRecipes;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\get;

it('renders canonical and hreflang links for localized pages', function () {
    get('/about', ['Accept-Language' => 'id'])
        ->assertOk()
        ->assertSee('rel="canonical" href="'.url('/about').'"', false)
        ->assertSee('hreflang="id" href="'.url('/about').'"', false)
        ->assertSee('hreflang="en" href="'.url('/en/about').'"', false)
        ->assertSee('hreflang="x-default" href="'.url('/about').'"', false);

    get('/en/about')
        ->assertOk()
        ->assertSee('rel="canonical" href="'.url('/en/about').'"', false);
});

it('uses the product detail query as its canonical url', function () {
    $product = \App\Models\Products\Product::query()->firstOrFail();

    get(route('product', ['product' => $product->slug]), ['Accept-Language' => 'id'])
        ->assertOk()
        ->assertSee(
            'rel="canonical" href="'.route('product', ['product' => $product->slug]).'"',
            false,
        );
});

it('prevents search result pages from being indexed', function () {
    Http::fake([
        '*' => Http::response('<html><head><title>Test</title></head><body>No result</body></html>'),
    ]);

    get(route('search', ['query' => 'not-found']), ['Accept-Language' => 'id'])
        ->assertOk()
        ->assertSee('name="robots" content="noindex, follow"', false);
});

it('builds a multilingual sitemap index with separated sitemap files', function () {
    (new BuildSitemap)->build();

    $index = file_get_contents(public_path('sitemap.xml'));
    $pages = file_get_contents(public_path('sitemap_pages.xml'));
    $products = file_get_contents(public_path('sitemap_products.xml'));
    $news = file_get_contents(public_path('sitemap_news.xml'));
    $recipes = file_get_contents(public_path('sitemap_recipes.xml'));

    expect($index)
        ->toContain('<sitemapindex')
        ->toContain(url('sitemap_pages.xml'))
        ->toContain(url('sitemap_products.xml'))
        ->toContain(url('sitemap_news.xml'))
        ->toContain(url('sitemap_recipes.xml'))
        ->not->toContain('<urlset');

    expect($pages)
        ->toContain(route('about'))
        ->toContain(route('about', ['locale' => 'en']))
        ->toContain(route('news'))
        ->toContain('hreflang="x-default"');

    expect($products)
        ->toContain(route('product', [
            'product' => \App\Models\Products\Product::query()->firstOrFail()->slug,
        ]))
        ->toContain('hreflang="en"');

    PostNews::query()->where('published', false)->each(
        fn (PostNews $post) => expect($news)->not->toContain(
            route('news.show', ['post' => $post->slug]),
        ),
    );

    PostRecipes::query()->where('published', false)->each(
        fn (PostRecipes $recipe) => expect($recipes)->not->toContain(
            route('recipe.show', ['recipe' => $recipe->slug]),
        ),
    );
});

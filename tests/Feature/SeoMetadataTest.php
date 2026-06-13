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

it('builds a multilingual sitemap with only published editorial content', function () {
    (new BuildSitemap)->build();

    $sitemap = file_get_contents(public_path('sitemap.xml'));

    expect($sitemap)
        ->toContain(route('about'))
        ->toContain(route('about', ['locale' => 'en']))
        ->toContain(route('news'))
        ->toContain('hreflang="x-default"')
        ->not->toContain('sitemap_news.xml')
        ->not->toContain('sitemap_recipes.xml');

    PostNews::query()->where('published', false)->each(
        fn (PostNews $post) => expect($sitemap)->not->toContain(
            route('news.show', ['post' => $post->slug]),
        ),
    );

    PostRecipes::query()->where('published', false)->each(
        fn (PostRecipes $recipe) => expect($sitemap)->not->toContain(
            route('recipe.show', ['recipe' => $recipe->slug]),
        ),
    );
});

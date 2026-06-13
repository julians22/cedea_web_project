<?php

use App\Models\Products\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\get;

beforeEach(function () {
    Cache::flush();
});

it('renders an empty search without scraping pages or querying a null keyword', function () {
    Http::fake();

    get(route('search'), ['Accept-Language' => 'id'])
        ->assertOk()
        ->assertSee('name="robots" content="noindex, follow"', false);

    Http::assertNothingSent();
});

it('searches every supported locale with grouped published constraints', function () {
    Http::fake([
        '*' => Http::response('<html><body>No matching page content</body></html>'),
    ]);

    DB::flushQueryLog();
    DB::enableQueryLog();

    get(route('search', ['query' => 'cedea']), ['Accept-Language' => 'id'])
        ->assertOk();

    $newsQuery = collect(DB::getQueryLog())->first(
        fn (array $query) => str_contains($query['query'], 'from `post_news`'),
    );

    expect($newsQuery)
        ->not->toBeNull()
        ->and($newsQuery['query'])->toContain('`published` = ? and (')
        ->and($newsQuery['query'])->not->toContain('$.*')
        ->and($newsQuery['bindings'])->toContain('$."id"', '$."en"');
});

it('links product results directly to the product detail', function () {
    Http::fake([
        '*' => Http::response('<html><body>No matching page content</body></html>'),
    ]);

    $product = Product::query()->firstOrFail();
    $keyword = $product->getTranslation('name', 'id');
    $url = route('product', [
        'locale' => 'id',
        'product' => $product->slug,
    ]).'#product-grid';

    get(route('search', ['query' => $keyword, 'lang' => 'id']), ['Accept-Language' => 'id'])
        ->assertOk()
        ->assertSee($url, false);
});

it('uses localized links for static page results', function () {
    Http::fake(function ($request) {
        $body = str_contains($request->url(), '/en/about')
            ? '<html><body>Company history keyword</body></html>'
            : '<html><body>No match</body></html>';

        return Http::response($body);
    });

    get(route('search', ['query' => 'history keyword', 'lang' => 'en']), ['Accept-Language' => 'id'])
        ->assertOk()
        ->assertSee(route('about', ['locale' => 'en']), false);
});

it('still renders when an internal page cannot be scraped', function () {
    Http::fake([
        '*' => Http::response('Unavailable', 503),
    ]);

    get(route('search', ['query' => 'not-found']), ['Accept-Language' => 'id'])
        ->assertOk();

    Http::assertSentCount(8);
});

it('rejects an excessively long search keyword', function () {
    get(route('search', ['query' => str_repeat('a', 101)]), ['Accept-Language' => 'id'])
        ->assertRedirect()
        ->assertSessionHasErrors('query');
});

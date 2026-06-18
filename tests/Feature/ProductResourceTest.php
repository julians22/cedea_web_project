<?php

use App\Livewire\Frontend\ProductList;
use App\Models\Products\Product;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

it('can render page', function () {
    livewire(ProductList::class)
        ->assertSuccessful()
        ->assertSeeHtml('data-item-id=')
        ->assertSeeHtml('data-item-name=');
});

it('tracks product selections and views in Google Analytics', function () {
    $template = file_get_contents(resource_path('views/livewire/product-list.blade.php'));

    expect($template)
        ->toContain("window.gtag('event', 'select_item'")
        ->toContain("window.gtag('event', 'view_item'")
        ->toContain('openProductModal($el.closest')
        ->toContain('this.trackProductSelection(product);')
        ->toContain('x-init="$nextTick(() => trackProductView($el.dataset))"')
        ->not->toContain('handleProductClick');
});

it('keys product cards at the loop root for reliable category filtering', function () {
    $template = file_get_contents(resource_path('views/livewire/product-list.blade.php'));

    expect($template)
        ->toContain('wire:key="product-card-{{ $item->id }}"')
        ->not->toContain('wire:key=\'{{ $item->slug }}\'');
});

it('renders analytics metadata when a product detail is active', function () {
    $product = Product::query()->firstOrFail();

    livewire(ProductList::class)
        ->call('handleChangeActiveProduct', $product->slug)
        ->assertSet('productSlug', $product->slug)
        ->assertSeeHtml('data-active-product')
        ->assertSeeHtml('data-item-id="'.$product->slug.'"');
});

it('tracks product views opened from a direct link', function () {
    $product = Product::query()->firstOrFail();

    get(route('product', ['product' => $product->slug]), ['Accept-Language' => 'id'])
        ->assertOk()
        ->assertSee('x-data="productCatalog(true)"', false)
        ->assertSee('data-active-product', false)
        ->assertSee('data-item-id="'.$product->slug.'"', false);
});

it('uses lightweight queries for the initial product catalog', function () {
    DB::flushQueryLog();
    DB::enableQueryLog();

    get(route('product'), ['Accept-Language' => 'id'])
        ->assertOk();

    $queries = collect(DB::getQueryLog());

    expect($queries->contains(
        fn (array $query) => str_contains($query['query'], 'where exists')
            && str_contains($query['query'], 'from `brands`'),
    ))->toBeFalse()
        ->and($queries->contains(
            fn (array $query) => $query['query'] === 'select * from `products` where `slug` = ? limit 1',
        ))->toBeFalse()
        ->and($queries->contains(
            fn (array $query) => str_contains(
                $query['query'],
                'select `id`, `name`, `size`, `slug`, `brand_id`, `order_column` from `products`',
            ),
        ))->toBeTrue();
});

it('binds product search terms instead of interpolating raw input', function () {
    $keyword = "fish%' OR 1=1 --";

    DB::flushQueryLog();
    DB::enableQueryLog();

    livewire(ProductList::class)
        ->set('keyword', $keyword)
        ->assertSuccessful();

    $searchQuery = collect(DB::getQueryLog())->first(
        fn (array $query) => str_contains($query['query'], 'json_extract')
            && collect($query['bindings'])->contains("%{$keyword}%"),
    );

    expect($searchQuery)
        ->not->toBeNull()
        ->and($searchQuery['query'])->not->toContain($keyword);
});

it('keeps brand category and keyword filters working together', function () {
    $product = Product::query()
        ->with(['brand', 'categories'])
        ->whereHas('categories')
        ->firstOrFail();

    livewire(ProductList::class)
        ->call('handleChangeActiveBrand', $product->brand->slug)
        ->set('activeCategory', $product->categories->first()->slug)
        ->set('keyword', $product->name)
        ->assertSee($product->fullname);
});

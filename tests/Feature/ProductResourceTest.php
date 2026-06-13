<?php

use App\Livewire\Frontend\ProductList;
use App\Models\Products\Product;

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
        ->toContain('trackProductSelection($el.closest')
        ->toContain('x-init="$nextTick(() => trackProductView($el.dataset))"')
        ->not->toContain('handleProductClick');
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

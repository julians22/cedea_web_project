<?php

use App\Livewire\Frontend\ProductList;
use App\Models\Products\Brand;
use App\Models\Products\Product;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

function productCatalogTemplates(): string
{
    return collect([
        resource_path('views/livewire/product-list.blade.php'),
        resource_path('views/components/product/brand-filter.blade.php'),
        resource_path('views/components/product/brand-logo.blade.php'),
        resource_path('views/components/product/card.blade.php'),
    ])->map(fn (string $path): string => file_get_contents($path))->implode("\n");
}

it('can render page', function () {
    livewire(ProductList::class)
        ->assertSuccessful()
        ->assertSeeHtml('data-item-id=')
        ->assertSeeHtml('data-item-name=');
});

it('tracks product selections and views in Google Analytics', function () {
    $template = productCatalogTemplates();

    expect($template)
        ->toContain("window.gtag('event', 'select_item'")
        ->toContain("window.gtag('event', 'view_item'")
        ->toContain('@click="handleProductTrigger($event, $wire)"')
        ->toContain('data-product-modal-trigger')
        ->toContain('wire.handleChangeActiveProduct(product.dataset.itemId);')
        ->toContain('this.trackProductSelection(product);')
        ->toContain('x-init="$nextTick(() => trackProductView($el.dataset))"')
        ->not->toContain('data-product-modal-trigger="desktop"')
        ->not->toContain('handleProductClick');
});

it('can close the Alpine product modal from Livewire filter changes', function () {
    $template = productCatalogTemplates();

    expect($template)
        ->toContain('x-data="productCatalog({{ $productSlug ? \'true\' : \'false\' }})"')
        ->toContain('@close-product-modal.window="closeProductModal()"')
        ->toContain('this.modalOpen = true;')
        ->toContain('this.modalOpen = false;');
});

it('delegates product modal clicks from the catalog root', function () {
    $template = productCatalogTemplates();

    expect($template)
        ->toContain('handleProductTrigger(event, wire)')
        ->toContain("event.target.closest('[data-product-modal-trigger]')")
        ->toContain("trigger.closest('[data-product-item]')")
        ->toContain('this.openProductModal(product.dataset);')
        ->not->toContain('$wire.handleChangeActiveProduct(\'{{ $item->slug }}\')');
});

it('uses css hover states for product cards after Livewire filtering', function () {
    $template = productCatalogTemplates();

    expect($template)
        ->toContain('group/product')
        ->toContain('hidden h-auto')
        ->toContain('lg:block')
        ->toContain('group-hover/product:opacity-100')
        ->toContain('group-hover/product:pointer-events-auto')
        ->not->toContain('x-data="hover"')
        ->not->toContain("Alpine.data('hover'");
});

it('keys product cards at the loop root for reliable category filtering', function () {
    $template = productCatalogTemplates();

    expect($template)
        ->toContain('wire:key="product-card-{{ $item->id }}"')
        ->not->toContain('wire:key=\'{{ $item->slug }}\'');
});

it('uses unique brand and category keys across catalog filters', function () {
    $template = productCatalogTemplates();

    expect($template)
        ->toContain('wire:key="brand-logo-{{ $brand->id }}"')
        ->toContain('wire:key="brand-filter-{{ $brand->id }}"')
        ->toContain('wire:key="brand-filter-{{ $brand->id }}-category-{{ $category->id }}"')
        ->not->toContain('wire:key=\'{{ $brand->slug }}\'')
        ->not->toContain('wire:key=\'{{ $category->slug }}\'');
});

it('clamps brand logo alt fallback text', function () {
    $template = productCatalogTemplates();

    expect($template)
        ->toContain('line-clamp-4 w-full object-contain text-center text-xs leading-tight')
        ->toContain('alt="{{ $brand->desc }} logo"');
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

it('opens product details after brand and category filters change', function () {
    $product = Product::query()
        ->with(['brand', 'categories'])
        ->whereHas('categories')
        ->firstOrFail();

    livewire(ProductList::class)
        ->call('handleChangeActiveBrand', $product->brand->slug)
        ->set('activeCategory', $product->categories->first()->slug)
        ->call('handleChangeActiveProduct', $product->slug)
        ->assertSet('productSlug', $product->slug)
        ->assertSeeHtml('data-active-product')
        ->assertSeeHtml('data-item-id="'.$product->slug.'"');
});

it('closes stale product details when brand changes', function () {
    $product = Product::query()->with('brand')->firstOrFail();
    $brand = Brand::query()
        ->whereKeyNot($product->brand_id)
        ->firstOrFail();

    livewire(ProductList::class)
        ->call('handleChangeActiveProduct', $product->slug)
        ->assertSet('productSlug', $product->slug)
        ->call('handleChangeActiveBrand', $brand->slug)
        ->assertSet('productSlug', null);
});

it('closes stale product details when category changes', function () {
    $product = Product::query()
        ->with(['brand', 'categories'])
        ->whereHas('categories')
        ->firstOrFail();

    livewire(ProductList::class)
        ->call('handleChangeActiveBrand', $product->brand->slug)
        ->call('handleChangeActiveProduct', $product->slug)
        ->assertSet('productSlug', $product->slug)
        ->set('activeCategory', $product->categories->first()->slug)
        ->assertSet('productSlug', null);
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

<?php

use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Models\Products\Brand;
use App\Models\Products\Product;
use App\Models\User;
use Filament\Tables\Columns\TextColumn;
use Livewire\Livewire;

function makeProduct(bool $enable): Product
{
    $brand = Brand::query()->firstOrCreate(
        ['id' => 1],
        ['name' => ['id' => 'Tab Test Brand']],
    );

    return Product::query()->create([
        'name' => ['id' => 'Tab Test Product'],
        'description' => ['id' => 'Tab Test Description'],
        'brand_id' => $brand->id,
        'enable' => $enable,
    ]);
}

function adminUser(): User
{
    return User::query()->where('email', 'admin@admin.com')->firstOrFail();
}

it('renders the enable column as a colored state badge', function () {
    $table = Livewire::actingAs(adminUser())
        ->test(ListProducts::class)
        ->instance()
        ->getTable();

    $column = $table->getColumn('enable');

    expect($column)
        ->toBeInstanceOf(TextColumn::class)
        ->and($column->isBadge())->toBeTrue()
        ->and($column->formatState(true))->toBe(__('Enabled'))
        ->and($column->formatState(false))->toBe(__('Disabled'))
        ->and($column->getColor(true))->toBe('success')
        ->and($column->getColor(false))->toBe('danger');
});

it('defaults to the enabled tab', function () {
    Livewire::actingAs(adminUser())
        ->test(ListProducts::class)
        ->assertSet('activeTab', __('Enabled'));
});

it('filters the table to enabled products by default', function () {
    $disabled = makeProduct(false);

    $query = Livewire::actingAs(adminUser())
        ->test(ListProducts::class)
        ->instance()
        ->getTable()
        ->getQuery();

    expect($query->toSql())
        ->toContain('`enable` = ?')
        ->and($query->getBindings())
        ->toContain(true)
        ->and($query->pluck('id')->all())
        ->not->toContain($disabled->id);
});

it('filters the table to disabled products on the disabled tab', function () {
    $enabled = makeProduct(true);
    $disabled = makeProduct(false);

    $component = Livewire::actingAs(adminUser())
        ->test(ListProducts::class)
        ->set('activeTab', __('Disabled'));

    $query = $component->instance()->getTable()->getQuery();

    expect($query->toSql())
        ->toContain('`enable` = ?')
        ->and($query->getBindings())
        ->toContain(false)
        ->and($query->pluck('id')->all())
        ->toContain($disabled->id)
        ->not->toContain($enabled->id);
});

it('lists all products on the all tab', function () {
    $enabled = makeProduct(true);
    $disabled = makeProduct(false);

    $component = Livewire::actingAs(adminUser())
        ->test(ListProducts::class)
        ->set('activeTab', __('all'));

    $query = $component->instance()->getTable()->getQuery();

    expect($query->toSql())
        ->not->toContain('`enable` = ?')
        ->and($query->pluck('id')->all())
        ->toContain($enabled->id)
        ->toContain($disabled->id);
});

it('shows the enabled and disabled counts as tab badges', function () {
    $component = Livewire::actingAs(adminUser())
        ->test(ListProducts::class);

    $tabs = $component->instance()->getCachedTabs();

    expect($tabs[__('all')]->getBadge())->toBe(Product::query()->count())
        ->and($tabs[__('Enabled')]->getBadge())->toBe(Product::query()->enabled()->count())
        ->and($tabs[__('Disabled')]->getBadge())->toBe(Product::query()->where('enable', false)->count())
        ->and($tabs[__('Enabled')]->getBadgeColor())->toBe('success')
        ->and($tabs[__('Disabled')]->getBadgeColor())->toBe('danger');
});

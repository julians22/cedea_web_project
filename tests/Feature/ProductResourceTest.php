<?php

use App\Livewire\Frontend\ProductList;

use function Pest\Livewire\livewire;

it('can render page', function () {
    livewire(ProductList::class)->assertSuccessful();
});

it('can', function () {});

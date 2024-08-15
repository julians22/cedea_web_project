<?php

use function Pest\Laravel\{get};


it('returns a successful response for home page', function () {
    get(route('home'))
        ->assertOk();
});

it('has about page', function () {
    get(route('about'))
        ->assertOk();
});

it('has product page', function () {
    get(route('product'))
        ->assertOk();
});

it('has recipe page', function () {
    get(route('recipe'))
        ->assertOk();
});

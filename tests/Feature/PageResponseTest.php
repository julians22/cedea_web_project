<?php

use function Pest\Laravel\get;

it('returns a successful response for home page', function () {
    get(route('home'), ['Accept-Language' => 'id'])
        ->assertOk();
});

it('has about page', function () {
    get(route('about'), ['Accept-Language' => 'id'])
        ->assertOk();
});

it('has product page', function () {
    get(route('product'), ['Accept-Language' => 'id'])
        ->assertOk();
});

it('has recipe page', function () {
    get(route('recipe'), ['Accept-Language' => 'id'])
        ->assertOk();
});

it('uses the unprefixed url for the default locale', function () {
    expect(route('about'))->toBe(url('/about'));
});

it('serves localized pages with a locale prefix', function () {
    get('/en/about')
        ->assertOk();
});

it('redirects an explicit default locale to its unprefixed url', function () {
    get('/id/about')
        ->assertRedirect('/about');
});

it('generates a url for an explicit locale', function () {
    expect(route('about', ['locale' => 'en']))->toBe(url('/en/about'));
});

<?php

use function Pest\Laravel\get;

it('tracks only direct marketplace logo clicks in Google Analytics', function () {
    $response = get(route('marketplace'), ['Accept-Language' => 'id'])
        ->assertOk();

    $response
        ->assertSee('data-marketplace-logo', false)
        ->assertSee('class="cursor-pointer"', false)
        ->assertSee('data-marketplace-name="pasar now"', false)
        ->assertSee("document.querySelectorAll('[data-marketplace-logo]')", false)
        ->assertSee("logo.addEventListener('click'", false)
        ->assertSee("window.gtag('event', 'marketplace_click'", false)
        ->assertSee('marketplace_name', false)
        ->assertSee('marketplace_type', false);

    expect($response->getContent())
        ->not->toContain("event.target.closest('[data-marketplace-logo]')")
        ->not->toContain("logo?.closest('[data-marketplace-track]')");
});

it('does not render anchors for marketplaces without a destination', function () {
    $content = get(route('marketplace'), ['Accept-Language' => 'id'])
        ->assertOk()
        ->getContent();

    expect($content)
        ->toMatch('/<a\b[^>]*href="https:\/\/www\.tokopedia\.com\/cedeaofficial"[^>]*>\s*<img\b[^>]*data-marketplace-name="tokopedia"/')
        ->not->toMatch('/<a\b[^>]*href="#[^"]*"[^>]*>\s*<img\b[^>]*data-marketplace-name="pasar now"/')
        ->not->toMatch('/<a\b[^>]*href="#[^"]*"[^>]*>\s*<img\b[^>]*data-marketplace-name="hypermart"/');
});

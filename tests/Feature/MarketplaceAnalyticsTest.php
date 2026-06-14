<?php

use function Pest\Laravel\get;

it('tracks only marketplace logo clicks in Google Analytics', function () {
    get(route('marketplace'), ['Accept-Language' => 'id'])
        ->assertOk()
        ->assertSee('data-marketplace-track', false)
        ->assertSee('data-marketplace-logo', false)
        ->assertSee("event.target.closest('[data-marketplace-logo]')", false)
        ->assertSee("logo?.closest('[data-marketplace-track]')", false)
        ->assertSee("window.gtag('event', 'marketplace_click'", false)
        ->assertSee('marketplace_name', false)
        ->assertSee('marketplace_type', false);
});

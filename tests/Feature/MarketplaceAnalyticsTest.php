<?php

use function Pest\Laravel\get;

it('tracks marketplace clicks in Google Analytics', function () {
    get(route('marketplace'), ['Accept-Language' => 'id'])
        ->assertOk()
        ->assertSee('data-marketplace-track', false)
        ->assertSee("window.gtag('event', 'marketplace_click'", false)
        ->assertSee('marketplace_name', false)
        ->assertSee('marketplace_type', false);
});

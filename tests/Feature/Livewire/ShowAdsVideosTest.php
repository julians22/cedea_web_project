<?php

use App\Livewire\ShowAdsVideos;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ShowAdsVideos::class)
        ->assertStatus(200);
});

<?php

use App\Livewire\ShowTvVideos;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ShowTvVideos::class)
        ->assertStatus(200);
});

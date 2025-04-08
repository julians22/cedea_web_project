<?php

use App\Livewire\ShowRecipeVideos;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ShowRecipeVideos::class)
        ->assertStatus(200);
});

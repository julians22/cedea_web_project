<?php

namespace App\Observers;

use App\Models\PostRecipes;
use Illuminate\Support\Facades\Artisan;

class RecipeObserver
{
    /**
     * Handle the PostRecipes "created" event.
     */
    public function created(PostRecipes $postRecipes): void
    {
        Artisan::call('app:generate-sitemap');
    }

    /**
     * Handle the PostRecipes "updated" event.
     */
    public function updated(PostRecipes $postRecipes): void
    {
        Artisan::call('app:generate-sitemap');
    }

    /**
     * Handle the PostRecipes "deleted" event.
     */
    public function deleted(PostRecipes $postRecipes): void
    {
        Artisan::call('app:generate-sitemap');
    }

    /**
     * Handle the PostRecipes "restored" event.
     */
    public function restored(PostRecipes $postRecipes): void
    {
        Artisan::call('app:generate-sitemap');
    }

    /**
     * Handle the PostRecipes "force deleted" event.
     */
    public function forceDeleted(PostRecipes $postRecipes): void
    {
        Artisan::call('app:generate-sitemap');
    }
}

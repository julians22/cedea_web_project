<?php

namespace App\Observers;

use App\Models\PostRecipes;

class RecipeObserver
{
    /**
     * Handle the PostRecipes "created" event.
     */
    public function created(PostRecipes $postRecipes): void
    {
        //
    }

    /**
     * Handle the PostRecipes "updated" event.
     */
    public function updated(PostRecipes $postRecipes): void
    {
        //
    }

    /**
     * Handle the PostRecipes "deleted" event.
     */
    public function deleted(PostRecipes $postRecipes): void
    {
        //
    }

    /**
     * Handle the PostRecipes "restored" event.
     */
    public function restored(PostRecipes $postRecipes): void
    {
        //
    }

    /**
     * Handle the PostRecipes "force deleted" event.
     */
    public function forceDeleted(PostRecipes $postRecipes): void
    {
        //
    }
}

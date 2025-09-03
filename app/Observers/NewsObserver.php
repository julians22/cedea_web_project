<?php

namespace App\Observers;

use App\Models\PostNews;
use Illuminate\Support\Facades\Artisan;

class NewsObserver
{
    /**
     * Handle the PostNews "created" event.
     */
    public function created(PostNews $news): void
    {
        Artisan::call('app:generate-sitemap');
    }

    /**
     * Handle the PostNews "updated" event.
     */
    public function updated(PostNews $news): void
    {
        Artisan::call('app:generate-sitemap');
    }

    /**
     * Handle the PostNews "deleted" event.
     */
    public function deleted(PostNews $news): void
    {
        Artisan::call('app:generate-sitemap');

    }

    /**
     * Handle the PostNews "restored" event.
     */
    public function restored(PostNews $news): void
    {
        Artisan::call('app:generate-sitemap');

    }

    /**
     * Handle the PostNews "force deleted" event.
     */
    public function forceDeleted(PostNews $news): void
    {
        Artisan::call('app:generate-sitemap');

    }
}

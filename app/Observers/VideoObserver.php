<?php

namespace App\Observers;

use App\Models\Video;
use Illuminate\Support\Facades\Artisan;

class VideoObserver
{
    /**
     * Handle the Video "created" event.
     */
    public function created(Video $video): void
    {
        Artisan::call('app:generate-sitemap');
    }

    /**
     * Handle the Video "updated" event.
     */
    public function updated(Video $video): void
    {
        Artisan::call('app:generate-sitemap');
    }

    /**
     * Handle the Video "deleted" event.
     */
    public function deleted(Video $video): void
    {
        Artisan::call('app:generate-sitemap');
    }

    /**
     * Handle the Video "restored" event.
     */
    public function restored(Video $video): void
    {
        Artisan::call('app:generate-sitemap');
    }

    /**
     * Handle the Video "force deleted" event.
     */
    public function forceDeleted(Video $video): void
    {
        Artisan::call('app:generate-sitemap');
    }
}

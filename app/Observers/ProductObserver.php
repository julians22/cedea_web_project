<?php

namespace App\Observers;

use App\Models\Products\Product;
use Illuminate\Support\Facades\Artisan;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        Artisan::call('app:generate-sitemap');
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        Artisan::call('app:generate-sitemap');
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        Artisan::call('app:generate-sitemap');
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        Artisan::call('app:generate-sitemap');
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        Artisan::call('app:generate-sitemap');
    }
}

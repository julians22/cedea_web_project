<?php

namespace App\Providers;

use Spatie\Translatable\Facades\Translatable;
use Illuminate\Support\ServiceProvider;

class TranslateableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        Translatable::fallback(
            fallbackAny: true,
        );
    }
}

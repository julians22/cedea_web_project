<?php

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales([
                    'en',
                    'id',
                    // 'ko'
                ]); // also accepts a closure
        });

        DateTimePicker::configureUsing(fn (DateTimePicker $component) => $component->format('Y-m-d H:i:s'));
        DateTimePicker::configureUsing(fn (DateTimePicker $component) => $component->native(false));
    }
}

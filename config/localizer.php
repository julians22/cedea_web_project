<?php

declare(strict_types=1);

use NielsNumbers\LaravelLocalizer\Detectors\BrowserDetector;
use NielsNumbers\LaravelLocalizer\Detectors\UserDetector;

return [
    'supported_locales' => ['id', 'en'],

    'locale_names' => [
        'id' => 'Bahasa Indonesia',
        'en' => 'English',
    ],

    'hide_default_locale' => true,

    'redirect_enabled' => true,

    'persist_locale' => [
        'session' => true,
        'cookie' => true,
    ],

    'detectors' => [
        UserDetector::class,
        BrowserDetector::class,
    ],

    'locale_directions' => [],
];

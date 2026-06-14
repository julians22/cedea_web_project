<?php

declare(strict_types=1);

use NielsNumbers\LaravelLocalizer\Detectors\BrowserDetector;
use NielsNumbers\LaravelLocalizer\Detectors\UserDetector;

$locales = [
    'id' => [
        'name' => 'Bahasa Indonesia',
        'open_graph' => 'id_ID',
    ],
    'en' => [
        'name' => 'English',
        'open_graph' => 'en_US',
    ],
];

return [
    'supported_locales' => array_keys($locales),

    'locale_names' => array_map(
        fn (array $locale): string => $locale['name'],
        $locales,
    ),

    'open_graph_locales' => array_map(
        fn (array $locale): string => $locale['open_graph'],
        $locales,
    ),

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

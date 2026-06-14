<?php

use App\Filament\Resources\NewsResource;
use App\Filament\Resources\ProductResource;
use App\Filament\Resources\VideoResource;
use App\Support\Localization;

it('uses one locale configuration across SEO and Filament', function () {
    expect(Localization::locales())
        ->toBe(['id', 'en'])
        ->and(Localization::labels())
        ->toBe([
            'id' => 'Bahasa Indonesia',
            'en' => 'English',
        ])
        ->and(Localization::openGraphLocale('id'))->toBe('id_ID')
        ->and(Localization::openGraphLocale('en'))->toBe('en_US')
        ->and(ProductResource::getTranslatableLocales())->toBe(Localization::locales())
        ->and(NewsResource::getTranslatableLocales())->toBe(Localization::locales())
        ->and(VideoResource::getTranslatableLocales())->toBe(Localization::locales());
});

it('automatically applies validation rules to a newly enabled locale', function () {
    config()->set('localizer.supported_locales', ['id', 'en', 'ko']);
    config()->set('localizer.locale_names.ko', '한국어');
    config()->set('localizer.open_graph_locales.ko', 'ko_KR');

    $rules = Localization::rules(['string', 'max:255'], required: true);

    expect(Localization::labels()['ko'])->toBe('한국어')
        ->and(Localization::openGraphLocale('ko'))->toBe('ko_KR')
        ->and($rules['id'])->toBe(['required', 'string', 'max:255'])
        ->and($rules['en'])->toBe(['nullable', 'string', 'max:255'])
        ->and($rules['ko'])->toBe(['nullable', 'string', 'max:255']);
});

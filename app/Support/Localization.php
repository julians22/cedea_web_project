<?php

namespace App\Support;

use Closure;
use NielsNumbers\LaravelLocalizer\Facades\Localizer;

final class Localization
{
    /**
     * @return array<int, string>
     */
    public static function locales(): array
    {
        return config('localizer.supported_locales', []);
    }

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return config('localizer.locale_names', []);
    }

    /**
     * @param  array<int, mixed>|Closure(): array<int, mixed>  $rules
     * @return array<string, array<int, mixed>>
     */
    public static function rules(array|Closure $rules = [], bool $required = false): array
    {
        $defaultLocale = Localizer::defaultLocale();

        return collect(self::locales())
            ->mapWithKeys(function (string $locale) use ($rules, $required, $defaultLocale): array {
                $localeRules = $rules instanceof Closure ? $rules() : $rules;

                return [
                    $locale => [
                        $required && $locale === $defaultLocale ? 'required' : 'nullable',
                        ...$localeRules,
                    ],
                ];
            })
            ->all();
    }

    public static function openGraphLocale(string $locale): string
    {
        return config(
            "localizer.open_graph_locales.{$locale}",
            str_replace('-', '_', $locale),
        );
    }
}

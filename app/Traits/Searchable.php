<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

trait Searchable
{
    /**
     * Apply a case-insensitive search to a query builder.
     *
     * @param  string|array  $field
     * @param  string  $keyword
     */
    public function scopeSearch(Builder $query, string|array $fields, mixed $keyword): Builder
    {
        $keyword = trim((string) $keyword);

        if ($keyword === '') {
            return $query;
        }

        $keyword = mb_strtolower($keyword);

        return $query->where(function (Builder $searchQuery) use ($fields, $keyword): void {
            foreach (Arr::wrap($fields) as $field) {
                $column = collect(explode('.', $field))
                    ->map(fn (string $segment) => '`'.str_replace('`', '``', $segment).'`')
                    ->implode('.');

                $searchQuery->orWhereRaw("LOWER({$column}) LIKE ?", ["%{$keyword}%"]);
            }
        });
    }

    /**
     * Apply a case-insensitive search to a query builder, using translations.
     *
     * @param  string  $keyword
     */
    public function scopeSearchTranslated(
        Builder $query,
        string|array $fields,
        mixed $keyword,
        ?string $locale = null,
    ): Builder {
        $keyword = trim((string) $keyword);

        if ($keyword === '') {
            return $query;
        }

        $locales = $locale === '*'
            ? config('localizer.supported_locales', [App::getLocale()])
            : [$locale ?? App::getLocale()];
        $keyword = mb_strtolower($keyword);

        return $query->where(function (Builder $searchQuery) use ($fields, $keyword, $locales): void {
            foreach (Arr::wrap($fields) as $field) {
                $column = collect(explode('.', $field))
                    ->map(fn (string $segment) => '`'.str_replace('`', '``', $segment).'`')
                    ->implode('.');

                foreach ($locales as $searchLocale) {
                    $searchQuery->orWhereRaw(
                        "LOWER(JSON_UNQUOTE(JSON_EXTRACT({$column}, ?))) LIKE ?",
                        ['$."'.str_replace('"', '\"', $searchLocale).'"', "%{$keyword}%"],
                    );
                }
            }
        });
    }
}

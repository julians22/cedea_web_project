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
     * @return Builder
     */
    public static function scopeSearch(Builder $query, string|array $fields, $keyword)
    {
        $keyword = strtolower($keyword);

        if (is_string($fields)) {
            $fields = Arr::wrap($fields);
        }

        foreach ($fields as $field) {
            $field = '"' . str_replace('.', '"."', $field) . '"';
            $query->orWhereRaw('LOWER(' . $field . ') LIKE ?', ['%' . $keyword . '%']);
        }

        return $query;
    }

    /**
     * Apply a case-insensitive search to a query builder, using translations.
     *
     * @param  Builder  $query
     * @param  string|array  $fields
     * @param  string  $keyword
     * @param  string  $locale
     * @return Builder
     */
    public static function scopeSearchTranslated(Builder $query, string|array $fields, $keyword, string $locale = null)
    {
        $locale = $locale ?? App::getLocale();

        $keyword = strtolower($keyword);

        if (is_string($fields)) {
            $fields = Arr::wrap($fields);
        }

        foreach ($fields as $field) {
            $field = 'LOWER(JSON_EXTRACT(' . $field . ', "$.' . $locale . '"))';

            $query->orWhereRaw($field . ' LIKE ?', ['%' . $keyword . '%']);
        }

        return $query;
    }
}

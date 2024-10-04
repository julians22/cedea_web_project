<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sitemap\Tags\News;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class NewsCategory extends Model
{
    use HasTranslations, HasSlug;

    public $translatable = ['name'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->usingLanguage('id')
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * The news that belong to the NewsCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class);
    }
}

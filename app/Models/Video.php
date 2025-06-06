<?php

namespace App\Models;

use App\Traits\Searchable;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sitemap\Tags\Url;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

class Video extends Model implements HasMedia
{
    use HasFactory,
        HasSlug,
        InteractsWithMedia,
        HasTranslations,
        HasTags,
        Searchable;

    public $translatable = ['title', 'description'];

    protected $casts = [
        'video' => 'array', // or 'json'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'slug'];

    /**
     * Get the excerpt.
     *
     * @return string
     */
    protected function thumbnail(): Attribute
    {
        return Attribute::make(
            get: function (string $value): string {
                return $this->use_custom_thumbnail ?
                    $this->getFirstMediaUrl('thumbnail')
                    : $value;
            },
        );
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->usingLanguage('id')
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

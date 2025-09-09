<?php

namespace App\Models;

use App\Observers\VideoObserver;
use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

#[ObservedBy([VideoObserver::class])]
class Video extends Model implements HasMedia, Sitemapable
{
    use HasFactory,
        HasSlug,
        HasTags,
        HasTranslations,
        InteractsWithMedia,
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

    /**
     * Get the sitemap tag for the resource.
     */
    public function toSitemapTag(): Url|string|array
    {
        return Url::create(route('videos', $this))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
    }
}

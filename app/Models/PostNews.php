<?php

namespace App\Models;

use App\Observers\NewsObserver;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

#[ObservedBy([NewsObserver::class])]
class PostNews extends Model implements HasMedia, Sitemapable
{
    use HasFactory,
        HasSlug,
        HasTags,
        HasTranslations,
        InteractsWithMedia,
        Searchable;

    public $translatable = ['title', 'content', 'excerpt', 'featured_image_caption'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published' => 'boolean',
    ];

    /**
     * Get the excerpt.
     *
     * @return string
     */
    protected function excerpt(): Attribute
    {
        return Attribute::make(
            get: function (string $value): string {
                if (empty($value)) {
                    return Str::limit(strip_tags((string) $this->content), 200);
                }

                return $value;
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
     * Generate a non-unique slug for the post.
     *
     * If a custom slug has been used and is not empty, it returns the custom slug.
     * Otherwise, it generates a slug from the source string using the specified separator and language.
     * Also strip tags from the source string.
     *
     * @return string The generated slug.
     */
    protected function generateNonUniqueSlug(): string
    {
        $slugField = $this->slugOptions->slugField;

        if ($this->hasCustomSlugBeenUsed() && ! empty($this->$slugField)) {
            return $this->$slugField;
        }

        return Str::slug(strip_tags($this->getSlugSourceString()), $this->slugOptions->slugSeparator, $this->slugOptions->slugLanguage);
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
        return Url::create(route('news.show', $this))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.1);
    }

    /**
     * The categories that belong to the PostNews
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(NewsCategory::class, 'post_news_news_category');
    }
}

<?php

namespace App\Models\Products;

use App\Models\PostRecipes;
use App\Traits\Searchable;
use Attribute;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;
use Spatie\Translatable\Translatable;

class Product extends Model implements HasMedia
{
    use HasSlug,
        InteractsWithMedia,
        HasFactory,
        HasTranslations,
        Searchable;

    public $translatable = ['name', 'size', 'description', 'packaging'];

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
        'packaging' => 'array',
        'have_video' => 'boolean',
        'video' => 'array'
    ];

    /**
     * Get the packaging.
     */
    protected function packaging(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                dd($value);
            },
        );
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('packaging')
            ->singleFile();

        $this
            ->addMediaCollection('featured_packaging')
            ->singleFile();
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->usingLanguage('id')
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->format('webp');

        $this->addMediaConversion('preview_cropped')
            ->format('webp');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * The category that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    /**
     * Get all of the recipes for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recipes(): HasMany
    {
        return $this->hasMany(PostRecipes::class);
    }

    /**
     * Filter out empty or disallowed translations
     * Modified to filter out empty array
     *
     * @param mixed $value
     * @param string|null $locale
     * @param array|null $allowedLocales
     * @return bool
     */
    protected function filterTranslations(mixed $value = null, string $locale = null, array $allowedLocales = null): bool
    {
        if ($value === null) {
            return false;
        }

        if ($value === '') {
            return false;
        }

        if ($value === []) {
            return false;
        }

        if ($allowedLocales === null) {
            return true;
        }

        if (! in_array($locale, $allowedLocales)) {
            return false;
        }

        return true;
    }
}

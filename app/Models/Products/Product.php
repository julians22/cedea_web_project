<?php

namespace App\Models\Products;

use App\Models\PostRecipes;
use App\Traits\Searchable;
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
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Product extends Model implements HasMedia, Sortable
{
    use SortableTrait,
        HasSlug,
        InteractsWithMedia,
        HasFactory,
        HasTranslations,
        Searchable;

    public $translatable = ['name', 'size', 'description', 'packaging', 'fullname'];

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
     * Get the fullname.
     */
    protected function fullname(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => trim($this->name . ' ' . $this->size),
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
            ->generateSlugsFrom(['name', 'size'])
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

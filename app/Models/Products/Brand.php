<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Brand extends Model implements HasMedia, Sortable
{
    use HasFactory, HasSlug, HasTranslations, InteractsWithMedia, SortableTrait;

    public $translatable = ['name'];

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
        'in_nav' => 'boolean',
    ];

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

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('logo')
            ->singleFile();
    }

    /**
     * Scope a query to only include in nav
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInNav($query)
    {
        return $query->where('in_nav', true);
    }

    public function scopeForProductCatalog(Builder $query): Builder
    {
        return $query
            ->select(['id', 'name', 'desc', 'slug', 'order_column'])
            ->with([
                'media' => fn ($mediaQuery) => $mediaQuery->where('collection_name', 'logo'),
            ])
            ->orderBy('order_column');
    }

    /**
     * Get all of the product for the Brand
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}

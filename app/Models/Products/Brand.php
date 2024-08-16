<?php

namespace App\Models\Products;

use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use App\Livewire\Frontend\Products;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Brand extends Model implements HasMedia, Sortable
{
    use SortableTrait, InteractsWithMedia, HasFactory, HasTranslations, HasSlug;

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
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInNav($query)
    {
        return $query->where('in_nav', true);
    }

    /**
     * Get all of the product for the Brand
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}

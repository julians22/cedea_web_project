<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia, HasFactory, HasTranslations;

    public $translatable = ['name', 'description', 'packaging'];

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
        // 'ingredients' => 'array',
        'packaging' => 'array',
        'have_video' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('packaging')
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
        return $this->belongsToMany(Category::class);
    }
}

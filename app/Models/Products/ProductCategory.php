<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class ProductCategory extends Model
{
    use HasFactory, HasSlug, HasTranslations;

    public $translatable = ['name'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_categories';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

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

    /**
     * The products that belong to the category.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function scopeForProductCatalog(Builder $query): Builder
    {
        return $query
            ->select([
                'product_categories.id',
                'product_categories.name',
                'product_categories.slug',
                'product_categories.order_column',
                'products.brand_id',
            ])
            ->join(
                'product_product_category',
                'product_categories.id',
                '=',
                'product_product_category.product_category_id',
            )
            ->join('products', 'products.id', '=', 'product_product_category.product_id')
            ->distinct()
            ->orderBy('product_categories.order_column');
    }
}

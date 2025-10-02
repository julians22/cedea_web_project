<?php

namespace App\Actions;

use App\Models\PostNews;
use App\Models\PostRecipes;
use App\Models\Products\Product;
use App\Models\Video;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class BuildSitemap
{
    /**
     * Build the sitemap.
     */
    public function build(): void
    {
        Sitemap::create()
            ->add(Url::create('/')->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY))
            ->add(Url::create('/about')->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY))
            ->add(Url::create('/product')->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/videos')->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/marketplace')->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY))
            ->add(Url::create('/recipe')->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/contact')->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY))
            ->add($this->build_index(PostRecipes::all(), 'sitemap_recipes.xml'))
            ->add($this->build_index(PostNews::all(), 'sitemap_news.xml'))
            ->add($this->build_index(Video::all(), 'sitemap_videos.xml'))
            ->add($this->build_index(Product::all(), 'sitemap_products.xml'))
            ->writeToFile(public_path('sitemap.xml'));
    }

    /**
     * Build a sitemap index for the given model and save it to the specified path.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $path
     */
    protected function build_index($model, $path): string
    {
        Sitemap::create()
            ->add($model)
            ->writeToFile(public_path($path));

        return $path;
    }
}

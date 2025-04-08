<?php

namespace App\Actions;

use App\Models\PostNews;
use App\Models\PostRecipes;
use App\Models\Products\Product;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class BuildSitemap
{
    /**
     * Build the sitemap.
     *
     * @return void
     */

    public function build(): void
    {
        Sitemap::create()
            ->add($this->build_index(PostRecipes::all(), 'sitemap_recipes.xml'))
            ->add($this->build_index(PostNews::all(), 'sitemap_news.xml'))
            ->add(Url::create('/')->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->writeToFile(public_path('sitemap.xml'))
        ;
    }


    /**
     * Build a sitemap index for the given model and save it to the specified path.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $path
     * @return string
     */
    protected function build_index($model, $path): string
    {
        Sitemap::create()
            ->add($model)
            ->writeToFile(public_path($path));

        return $path;
    }
}

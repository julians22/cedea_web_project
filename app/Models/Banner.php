<?php

namespace App\Models;

use App\Enums\BannerType;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Banner extends Model implements HasMedia, Sortable
{
    use InteractsWithMedia, SortableTrait;

    protected $casts = [
        'enable' => 'boolean',
        'type' => BannerType::class,
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('banner_desktop')
            ->singleFile();

        $this
            ->addMediaCollection('banner_mobile')
            ->singleFile();
    }
}

<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\EloquentSortable\SortableTrait;

class Banner extends Model implements HasMedia, Sortable
{
    use SortableTrait, InteractsWithMedia;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $casts = [
        'enable' => 'boolean',
    ];

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

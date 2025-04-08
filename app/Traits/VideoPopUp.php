<?php

namespace App\Traits;

use App\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

trait VideoPopUp
{
    public $activeVideo = null;

    function handleChangeActiveVideo(string $slug = '')
    {
        if (!$slug) {
            $this->reset('activeVideo');
        } else {
            $this->activeVideo = Video::where('slug', $slug)->first();
        }
    }
}

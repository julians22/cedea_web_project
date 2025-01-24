<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum VideoType: string implements HasLabel
{
    case RECIPE = 'recipe';
    case TV = 'tv';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::RECIPE => __('videos.type.recipe'),
            self::TV => __('videos.type.tv'),
        };
    }
}

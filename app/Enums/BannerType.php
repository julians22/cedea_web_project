<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum BannerType: string implements HasLabel
{
    case DEFAULT = 'default';
    case PARALLAX1 = 'parallax.v1';
    case PARALLAX2 = 'parallax.v2';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::DEFAULT => 'Default',
            self::PARALLAX1 => 'Parallax 1',
            self::PARALLAX2 => 'Parallax 2',
        };

    }
}

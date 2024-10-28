<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum RecipeType: string implements HasLabel
{
    case BREAKFAST = 'breakfast';
    case LUNCH = 'lunch';
    case DINNER = 'dinner';
    case SNACK = 'snack';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::BREAKFAST => __('meal.breakfast'),
            self::LUNCH => __('meal.lunch'),
            self::DINNER => __('meal.dinner'),
            self::SNACK => __('meal.snack'),
        };
    }
}

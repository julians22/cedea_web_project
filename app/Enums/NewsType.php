<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum NewsType: string implements HasLabel
{
    case ACTIVITY = 'activity';
    case ARTICLE = 'article';
    case CSR = 'csr';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ACTIVITY => __('news.type.activity'),
            self::ARTICLE => __('news.type.article'),
            self::CSR => __('news.type.csr'),
        };
    }
}

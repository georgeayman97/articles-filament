<?php

namespace App\Filament\Fields;

use App\Filament\Blocks\ArticleCard;
use Filament\Forms\Components\Builder;

class ArticleFooter
{
    public static function make(
        string $name,
        string $context = 'form',
    ): Builder {
        return Builder::make($name)
            ->blocks([
                ArticleCard::make(context: $context),
            ])
            ->collapsible();
    }
}

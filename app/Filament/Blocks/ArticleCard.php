<?php

namespace App\Filament\Blocks;

use App\Models\Article;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class ArticleCard
{
    public static function make(
        string $name = 'article_card',
        string $context = 'form',
    ): Block {
        return Block::make($name)
            ->schema([
                Select::make('post_id')
                    ->label('Post')
                    ->options(Article::orderBy('title')->pluck('title', 'id'))
                    ->required(),

                TextInput::make('text')
                    ->label('Link text (optional)'),
            ])
            ->label('Link to post')
            ->columns($context === 'form' ? 2 : 1);
    }
}

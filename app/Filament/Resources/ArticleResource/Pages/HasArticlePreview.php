<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Fields\ArticleContent;
use App\Filament\Fields\ArticleFooter;
use Filament\Forms\Components\Component;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasBuilderPreview;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

trait HasArticlePreview
{
    use HasPreviewModal;
    use HasBuilderPreview;

    protected function getActions(): array
    {
        return [
            PreviewAction::make()->label('Preview Changes'),
        ];
    }

    protected function getPreviewModalView(): ?string
    {
        return 'articles.show';
    }

    protected function getPreviewModalDataRecordKey(): ?string
    {
        return 'article';
    }

    protected function getBuilderPreviewView(string $builderName): ?string
    {
        return match ($builderName) {
            'content' => 'articles.preview-content',
            'footer_blocks' => 'articles.preview-footer',
        };
    }

    public static function getBuilderEditorSchema(string $builderName): Component|array
    {
        return match ($builderName) {
            'content' => ArticleContent::make(
                name: 'content',
                context: 'preview',
            )
                ->label('Content')
                ->columnSpanFull(),

            'footer_blocks' => ArticleFooter::make(
                name: 'footer_blocks',
                context: 'preview',
            )
                ->label('Footer')
                ->columnSpanFull(),
        };
    }
}

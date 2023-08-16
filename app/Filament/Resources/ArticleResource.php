<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use App\Models\Category;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Get;
use Illuminate\Validation\Rules\Unique;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationGroup = 'Article';

    protected static ?string $navigationIcon = 'heroicon-s-pencil-square';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                        if ($operation !== 'create') {
                                            return;
                                        }

                                        $set('slug', Str::slug($state));
                                    }),

                                Forms\Components\TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->unique(Article::class, 'slug', ignoreRecord: true),

                                Forms\Components\Select::make('status')
                                    ->options([
                                        'active' => 'Active',
                                        'in-active' => 'In Active',
                                    ])
                                    ->default('active'),

                                Forms\Components\MarkdownEditor::make('content')
                                    ->columnSpan('full'),
                            ])
                            ->columns(3),
                    ])
                    ->columnSpan(['lg' => 2]),
                Forms\Components\Section::make('Attachment')
                    ->schema([
                        Forms\Components\Checkbox::make('is_image')
                            ->label('Add Image')
                            ->hidden(fn (Get $get): bool => $get('is_video'))
                            ->live(),
                        Forms\Components\Checkbox::make('is_video')
                            ->label('Add Video')
                            ->hidden(fn (Get $get): bool => $get('is_image'))
                            ->live(),
                        Forms\Components\FileUpload::make('image')
                            ->label('Image')
                            ->image()
                            ->visible(fn (Get $get): bool => $get('is_image'))
                            ->requiredIf('is_image', true)
                            ->disableLabel(),
                        Forms\Components\FileUpload::make('video')
                            ->label('Video')
                            ->visible(fn (Get $get): bool => $get('is_video'))
                            ->requiredIf('is_video', 1)
                            ->disableLabel(),
                    ])
                    ->collapsible(),
                Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make('Associations')
                        ->schema([
                            Forms\Components\Select::make('author_id')
                                ->relationship('author', 'name')
                                ->searchable()
                                ->createOptionForm([
                                    Forms\Components\TextInput::make('name')
                                        ->required(),
                                    Forms\Components\Select::make('status')
                                        ->options([
                                            'active' => 'Active',
                                            'in-active' => 'In Active',
                                        ])
                                        ->default('active'),
                                    Forms\Components\MarkdownEditor::make('bio')
                                        ->columnSpan('full'),
                                    Forms\Components\Section::make('Image')
                                        ->schema([
                                            Forms\Components\FileUpload::make('image')
                                            ->label('Image')
                                            ->image()
                                            ->disableLabel(),
                                        ])
                                        ->collapsible(),
                                ]),
                            Forms\Components\Select::make('tags')
                                ->relationship('tags', 'name')
                                ->multiple()
                                ->required()
                                ->createOptionForm([
                                    Forms\Components\TextInput::make('name')
                                        ->maxValue(50)
                                        ->required(),
                                    Forms\Components\Select::make('status')
                                        ->options([
                                            'active' => 'Active',
                                            'in-active' => 'In Active',
                                        ])
                                        ->default('active'),
                                ]),
                            Forms\Components\Select::make('categories')
                                ->relationship('categories', 'name')
                                ->multiple()
                                ->required()
                                ->createOptionForm([
                                    Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxValue(50)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'createOption' ? $set('slug', Str::slug($state)) : null),

                                Forms\Components\TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->unique(Category::class, 'slug', ignoreRecord: true),

                                Forms\Components\Select::make('status')
                        ->options([
                                        'active' => 'Active',
                                        'in-active' => 'In Active',
                                    ])
                                    ->default('active'),
                            ]),

                            Forms\Components\Select::make('parent_id')
                                ->label('Parent')
                                ->relationship('parent', 'name', fn (Builder $query) => $query->where('parent_id', null))
                                ->searchable()
                                ->placeholder('Select parent category'),
                            ])
                            ->columnSpan(['lg' => fn (?Category $record) => $record === null ? 3 : 2]),

                            Forms\Components\Section::make('Image')
                                    ->schema([
                                        Forms\Components\FileUpload::make('image')
                                            ->label('Image')
                                            ->image()
                                            ->disableLabel(),
                                    ])
                                    ->collapsible(),
                            Forms\Components\Section::make()
                                ->schema([
                                    Forms\Components\Placeholder::make('created_at')
                                        ->label('Created at')
                                        ->content(fn (Category $record): ?string => $record->created_at?->diffForHumans()),

                                    Forms\Components\Placeholder::make('updated_at')
                                        ->label('Last modified at')
                                        ->content(fn (Category $record): ?string => $record->updated_at?->diffForHumans()),
                                ])
                                ->columnSpan(['lg' => 1])
                                ->hidden(fn (?Category $record) => $record === null),
                            ]),
                        ]),
                ])
                ->columnSpan(['lg' => 2]),

            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->toggleable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('video')
                    ->label('Video')
                    ->toggleable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Title')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'danger' => 'in-active',
                        'success' => 'active',
                    ])
                    ->toggleable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->searchable()
                    ->label('Author')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('categories.name')
                    ->label('Categories')
                    ->listWithLineBreaks()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('tags.name')
                    ->label('Tags')
                    ->badge()
                    ->listWithLineBreaks()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'in-active' => 'In Active',
                    ])
                    ->native(false),
                Tables\Filters\SelectFilter::make('author_id')
                    ->label('Author')
                    ->relationship('author', 'name')
                    ->searchable()
                    ->native(false),
                Tables\Filters\SelectFilter::make('categories')
                    ->relationship('categories', 'name')
                    ->multiple()
                    ->searchable()
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}

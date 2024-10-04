<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use App\Models\PostNews;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsResource extends Resource
{
    protected static ?string $model = PostNews::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('Posts');
    }

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make(
                    [
                        Section::make(
                            [
                                TextInput::make('title')
                                    ->label(__('title'))
                                    ->translatable(true, null, [
                                        'id' => ['required', 'string', 'max:255'],
                                        'en' => ['nullable', 'string', 'max:255'],
                                    ]),

                                Textarea::make('excerpt')
                                    ->autosize()
                                    ->translatable(true, null, [
                                        'id' => ['required', 'string'],
                                        'en' => ['nullable', 'string'],
                                    ])

                                // RichEditor::make('content')
                                //     ->label(__('content'))
                                //     ->translatable(true, null, [
                                //         'id' => ['required', 'string',],
                                //         'en' => ['nullable', 'string',],
                                //     ]),
                            ]
                        ),
                        Section::make([
                            SpatieMediaLibraryFileUpload::make('featured_image')
                                ->image()
                                ->required()
                                ->collection('featured_image'),

                            Toggle::make('published')
                                ->default(true)
                                ->onColor('success'),
                            // ->offColor('danger'),

                            DatePicker::make('published_at')
                                ->required()
                                ->default(now())



                        ]),

                    ]
                ),
                TiptapEditor::make('content')
                    ->profile('default')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp',])

                    ->translatable(true, null, [
                        'id' => ['required',],
                        'en' => ['nullable',],
                    ]),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('featured_image')
                    ->collection('featured_image'),
                TextColumn::make('title'),
                ToggleColumn::make('published')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Enums\RecipeType;
use App\Filament\Resources\RecipeResource\Pages;
use App\Filament\Resources\RecipeResource\RelationManagers;
use App\Models\PostRecipes;
use App\Models\Recipe;
use Awcodes\Matinee\Matinee;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecipeResource extends Resource
{
    protected static ?string $model = PostRecipes::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('Posts');
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
                                        // 'ko' => ['nullable', 'string', 'max:255'],
                                    ]),

                                Textarea::make('description')
                                    ->translatable(true, null, [
                                        'id' => ['nullable', 'string', 'max:255'],
                                        'en' => ['nullable', 'string', 'max:255'],
                                        // 'ko' => ['nullable', 'string', 'max:255'],
                                    ]),

                                Repeater::make('ingredients')
                                    ->schema([
                                        TextInput::make('title'),
                                        TableRepeater::make('ingredient_group')
                                            ->headers([
                                                Header::make('unit'),
                                                Header::make('name'),
                                            ])
                                            ->schema([
                                                TextInput::make('unit'),
                                                TextInput::make('name'),
                                            ])
                                            ->label('ingredient list'),
                                    ])
                                    ->translatable()
                                    ->default([]),
                            ]
                        ),
                        Section::make([
                            SpatieMediaLibraryFileUpload::make('featured_image')
                                ->required()
                                ->collection('featured_image'),
                            Matinee::make('video'),
                            Select::make('recipe_type')
                                ->options(RecipeType::class)
                                // ->options([
                                //     'breakfast' => 'Sarapan',
                                //     'lunch' => 'Makan Siang',
                                //     'dinner' => 'Makan Malam',
                                //     'snack' => 'Snack',
                                // ])
                                ->required(),

                            Select::make('product')
                                ->relationship('product')
                                ->getOptionLabelFromRecordUsing(fn($record) => $record->name)
                                ->searchable(['name'])
                                ->nullable(),

                            SpatieTagsInput::make('tags')
                                ->type('recipe'),

                            Toggle::make('published')
                                ->default(true)
                                ->onColor('success')
                                ->offColor('danger'),


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
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'edit' => Pages\EditRecipe::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Models\Products\Brand;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('Products');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('name'))
                    ->translatable(
                        true,
                        null,
                        [
                            'id' => [
                                'required',
                                fn (Get $get) => UniqueTranslationRule::for('brands', 'name')->ignore($get('id')),
                                'string',
                                'max:255',
                            ],
                            'en' => [
                                'nullable',
                                fn (Get $get) => UniqueTranslationRule::for('brands', 'name')->ignore($get('id')),
                                'string',
                                'max:255',
                            ],
                        ]
                    ),
                TextInput::make('desc')
                    ->label(__('description')),
                SpatieMediaLibraryFileUpload::make('image')
                    ->required()
                    ->columnSpanFull()
                    ->collection('logo')
                    ->maxFiles(1)
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        null,
                        '1:1',
                    ])
                    ->imageEditorEmptyFillColor('#fff'),
                Toggle::make('in_nav'),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('logo'),
            ])
            ->reorderable('order_column')
            ->defaultSort('order_column')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}

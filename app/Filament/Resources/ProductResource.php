<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Products\Product;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Builder;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('Products');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                [Split::make(
                    [
                        Section::make([
                            SpatieMediaLibraryFileUpload::make('image')
                                ->collection('products')
                                ->image(),
                            TextInput::make('name')
                                ->label(__('Name'))
                                ->translatable(true, ['id' => __('Indonesia'), 'en' => __('English')]),
                            RichEditor::make('description')
                                ->label(__('Description'))
                                ->translatable(true, ['id' => __('Indonesia'), 'en' => __('English')]),
                        ]),

                        Section::make([
                            Select::make('category_id')
                                ->relationship(
                                    name: 'categories',
                                    titleAttribute: 'name',
                                )
                                ->getOptionLabelFromRecordUsing(fn($record) => $record->getTranslation('name', App::currentLocale()))
                                // ->options(Category::all()->pluck('name', 'id'))
                                ->label(__('category_id'))
                                ->multiple()->translatable(false)
                                ->searchable(['name'])
                                ->preload(),
                            Select::make('brand_id')
                                ->label(__('brand'))
                                ->relationship(name: 'brand', titleAttribute: 'name')
                                ->getOptionLabelFromRecordUsing(fn($record) => $record->getTranslation('name', App::currentLocale()))
                        ])->grow(false),
                    ],
                )->from('xl')]
            )->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('slug'),
                TextColumn::make('brand.name'),
                TextColumn::make('categories.name')
                    ->label('Categories')
                    ->listWithLineBreaks()
                    ->limitList(2)
                    ->expandableLimitedList(),

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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

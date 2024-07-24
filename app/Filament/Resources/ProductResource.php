<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Http\Resources\Utils\TagToolResource;
use App\Models\Products\Category;
use App\Models\Products\Product;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Tags\Tag;

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
        $tags = Tag::where('type', 'product_tags')->get('name');

        $suggestions = [];

        foreach ($tags as $key => $value) {
            $suggestions[] = $value->name;
        }

        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->translatable(true, ['id' => __('Indonesia'), 'en' => __('English')]),
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('products'),
                RichEditor::make('description')
                    ->label(__('Description'))
                    ->translatable(true, ['id' => __('Indonesia'), 'en' => __('English')]),
                SpatieTagsInput::make('tags')
                    ->suggestions($suggestions)
                    ->type('product_tags'),
                Select::make('category_id')
                    ->label(__('Category'))
                    ->relationship(name: 'category', titleAttribute: 'title.id')
                    ->getOptionLabelFromRecordUsing(fn (Category $record) => $record->title)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('slug'),
                TextColumn::make('category.title'),

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

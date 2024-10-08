<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Products\Brand;
use App\Models\Products\Category;
use App\Models\Products\Product;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Builder;


class ProductResource extends Resource
{
    use Translatable;

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

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
                                ->required()
                                ->maxFiles(1)
                                ->image()
                                ->conversion('preview_cropped')
                                ->collection('packaging'),

                            SpatieMediaLibraryFileUpload::make('featured_image')
                                ->maxFiles(1)
                                ->image()
                                ->conversion('thumb')
                                ->collection('featured_packaging'),

                            Toggle::make('have_video')
                                ->live(),
                            TextInput::make('video_link')
                                ->hidden(fn(Get $get): bool => ! $get('have_video')),

                            TextInput::make('name')
                                ->label(__('name'))
                                ->translatable(true, null, [
                                    'id' => ['required', 'string', 'max:255'],
                                    'en' => ['nullable', 'string', 'max:255'],
                                ]),
                            RichEditor::make('description')
                                ->label(__('description'))
                                ->translatable(true, null, [
                                    'id' => ['required', 'string'],
                                    'en' => ['nullable', 'string'],
                                ]),

                            TextInput::make('no_bpom')
                                // ->required()
                                ->label(__('no_bpom')),

                            TableRepeater::make('packaging')
                                ->headers([
                                    Header::make('unit'),
                                    Header::make('size'),
                                ])
                                ->schema([
                                    TextInput::make('unit'),
                                    TextInput::make('size'),
                                ])
                                ->label('Packaging list')
                                ->default([])
                                ->translatable(),
                        ]),

                        Section::make([
                            Select::make('category_id')
                                ->required()
                                ->relationship(
                                    name: 'categories',
                                    titleAttribute: 'name',
                                )
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->label(__('name'))
                                        ->translatable(
                                            true,
                                            null,
                                            [
                                                'id' => ['required', UniqueTranslationRule::for('categories', 'name'), 'string', 'max:255'],
                                                'en' => ['nullable', UniqueTranslationRule::for('categories', 'name'), 'string', 'max:255'],
                                            ]
                                        ),
                                ])
                                ->getOptionLabelFromRecordUsing(fn($record) => $record->name)
                                ->label(__('category'))
                                ->multiple()->translatable(false)
                                ->searchable(['name'])
                                ->preload(),
                            Select::make('brand_id')
                                ->required()
                                ->label(__('brand'))
                                ->relationship(name: 'brand', titleAttribute: 'name')
                                ->getOptionLabelFromRecordUsing(fn($record) => $record->name)
                        ])->grow(false),
                    ],
                )->from('xl')]
            )->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                // TextColumn::make('slug'),
                TextColumn::make('brand.name'),
                TextColumn::make('categories.name')
                    ->label('Categories')
                    ->listWithLineBreaks()
                    ->limitList(2)
                    ->expandableLimitedList(),

            ])
            ->filters([
                SelectFilter::make('brand')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->multiple()
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->name)
                    ->indicateUsing(function (array $data): array | string {
                        return implode(
                            ' & ',
                            Brand::select('id', 'name')->whereIn('id', $data['values'])->get()->pluck('name', 'id')->toArray()
                        );
                    })
                    ->preload(),
                SelectFilter::make('categorie')
                    ->relationship('categories', 'name')
                    ->searchable()
                    ->multiple()
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->name)
                    ->indicateUsing(function (array $data): array | string {
                        return implode(
                            ' & ',
                            Category::select('id', 'name')->whereIn('id', $data['values'])->get()->pluck('name', 'id')->toArray()
                        );
                    })
                    ->preload()
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

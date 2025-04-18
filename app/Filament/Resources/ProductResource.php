<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Products\Brand;
use App\Models\Products\Category;
use App\Models\Products\Product;
use App\Models\Products\ProductCategory;
use Awcodes\Matinee\Matinee;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Filament\Forms\Components\Actions\Action;
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
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
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

    /**
     * Implode array of strings to comma separated list with "and" before last element of array
     *
     * Example [1, 2, 3] => "1, 2 and 3"
     *
     * @param array $values
     * @return string | array
     */
    protected static function verboseImplode($values, $prefix = null)
    {
        if (count($values) === 0) {
            return [];
        }

        $prefix = $prefix ? $prefix . ' : ' : '';

        if (count($values) > 1) {
            $last = array_pop($values);
            return $prefix . implode(', ', $values) . ' & ' . $last;
        }

        return $prefix . implode($values);
    }

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

                            Matinee::make('video')
                                ->hidden(fn(Get $get): bool => ! $get('have_video')),

                            Split::make([
                                TextInput::make('name')
                                    ->label(__('name'))
                                    ->translatable(true, null, [
                                        'id' => ['required', 'string', 'max:255'],
                                        'en' => ['nullable', 'string', 'max:255'],
                                    ]),
                                TextInput::make('size')
                                    ->label(__('size'))
                                    ->translatable(true, null, [
                                        'id' => ['nullable', 'string', 'max:255'],
                                        'en' => ['nullable', 'string', 'max:255'],
                                    ])->grow(false),
                            ])->from('md'),

                            RichEditor::make('description')
                                ->label(__('description'))
                                ->translatable(true, null, [
                                    'id' => ['required', 'string'],
                                    'en' => ['nullable', 'string'],
                                ]),

                            TextInput::make('buy_link')
                                ->url()
                                ->suffixAction(
                                    fn(?string $state): Action =>
                                    Action::make('visit')
                                        ->icon('heroicon-m-globe-alt')
                                        ->url(
                                            filled($state) ? "{$state}" : null,
                                            shouldOpenInNewTab: true,
                                        ),
                                ),
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
                                                'id' => ['required', UniqueTranslationRule::for('product_categories', 'name'), 'string', 'max:255'],
                                                'en' => ['nullable', UniqueTranslationRule::for('product_categories', 'name'), 'string', 'max:255'],
                                            ]
                                        ),
                                ])
                                ->getOptionLabelFromRecordUsing(fn($record) => $record->name)
                                ->label(__('category'))
                                ->multiple()
                                ->translatable(false)
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
                Stack::make([
                    SpatieMediaLibraryImageColumn::make('image')
                        ->collection('packaging'),
                    TextColumn::make('name')
                        ->weight(FontWeight::SemiBold)
                        ->size(TextColumnSize::Large)
                        ->searchable(),
                    TextColumn::make('size'),
                    // TextColumn::make('slug'),
                    TextColumn::make('brand.name'),
                    TextColumn::make('categories.name')
                        ->label('Categories')
                        ->listWithLineBreaks()
                        ->limitList(2)
                        ->expandableLimitedList(),
                ]),
            ])
            ->reorderable('order_column')
            ->defaultSort('order_column')
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                SelectFilter::make('brand')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->multiple()
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->name)
                    ->indicateUsing(function (array $data): array | string {
                        return self::verboseImplode(
                            Brand::select('id', 'name')->whereIn('id', $data['values'])->get()->pluck('name', 'id')->toArray(),
                            'Brands'
                        );
                    })
                    ->preload(),
                SelectFilter::make('categories')
                    ->relationship('categories', 'name')
                    ->searchable()
                    ->multiple()
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->name)
                    ->indicateUsing(function (array $data): array | string {
                        return implode(
                            ' & ',
                            ProductCategory::select('id', 'name')->whereIn('id', $data['values'])->get()->pluck('name', 'id')->toArray()
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

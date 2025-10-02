<?php

namespace App\Filament\Resources;

use App\Enums\BannerType;
use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make(
                    [
                        Section::make([
                            Select::make('banner_type')
                                ->options(BannerType::class)
                                ->default(BannerType::DEFAULT)
                                ->live()
                                ->required()
                                ->selectablePlaceholder(false),
                            SpatieMediaLibraryFileUpload::make('desktop')
                                ->required(
                                    fn (Get $get): bool => $get('banner_type') ===
                                    BannerType::DEFAULT
                                )
                                ->hidden(
                                    fn (Get $get): bool => $get('banner_type') !== BannerType::DEFAULT
                                )
                                ->maxFiles(1)
                                ->image()
                                ->collection('banner_desktop'),
                            SpatieMediaLibraryFileUpload::make('mobile')
                                ->required(
                                    fn (Get $get): bool => $get('banner_type') === BannerType::DEFAULT
                                )
                                ->hidden(
                                    fn (Get $get): bool => $get('banner_type') !== BannerType::DEFAULT
                                )
                                ->maxFiles(1)
                                ->image()
                                ->collection('banner_mobile'),
                            SpatieMediaLibraryFileUpload::make('product')
                                ->required(
                                    fn (Get $get): bool => $get('banner_type') !==
                                    BannerType::DEFAULT
                                )
                                ->hidden(
                                    fn (Get $get): bool => $get('banner_type') === BannerType::DEFAULT
                                )
                                ->maxFiles(1)
                                ->image()
                                ->collection('banner_product'),

                            SpatieMediaLibraryFileUpload::make('particle_back')
                                ->hidden(
                                    fn (Get $get): bool => $get('banner_type') === BannerType::DEFAULT
                                )
                                ->panelLayout('grid')
                                ->multiple()
                                ->reorderable()
                                ->appendFiles()
                                ->image()
                                ->collection('banner_particle_back'),

                            SpatieMediaLibraryFileUpload::make('particle_front')
                                ->hidden(
                                    fn (Get $get): bool => $get('banner_type') === BannerType::DEFAULT
                                )
                                ->panelLayout('grid')
                                ->multiple()
                                ->reorderable()
                                ->appendFiles()
                                ->image()
                                ->collection('banner_particle_front'),

                            TextInput::make('title')
                                ->maxLength(255)
                                ->required(
                                    fn (Get $get): bool => $get('banner_type') !==
                                    BannerType::DEFAULT
                                )
                                ->helperText(__('optional')),
                            Textarea::make('desc')
                                ->rows(3)
                                ->maxLength(65535)
                                ->columnSpanFull()
                                ->hidden(
                                    fn (Get $get): bool => $get('banner_type') === BannerType::DEFAULT
                                )
                                ->helperText(__('optional')),

                            TextInput::make('link')
                                ->maxLength(255)
                                ->helperText(__('optional')),
                        ]),
                        Section::make([
                            Toggle::make('enable')
                                ->default(true)
                                ->onColor('success')
                                ->offColor('danger'),
                        ])->grow(false),
                    ]
                ),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('desktop')
                    ->collection('banner_desktop'),
                SpatieMediaLibraryImageColumn::make('mobile')
                    ->collection('banner_mobile'),
                TextColumn::make('link'),
                ToggleColumn::make('enable')
                    ->onColor('success')
                    ->offColor('danger'),
            ])
            ->reorderable('order_column')
            ->defaultSort('order_column')
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}

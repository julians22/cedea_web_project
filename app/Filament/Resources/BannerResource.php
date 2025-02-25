<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Banner;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BannerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use App\Filament\Resources\BannerResource\RelationManagers;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

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
                            SpatieMediaLibraryFileUpload::make('desktop')
                                ->required()
                                ->maxFiles(1)
                                ->image()
                                ->collection('banner_desktop'),
                            SpatieMediaLibraryFileUpload::make('mobile')
                                ->required()
                                ->maxFiles(1)
                                ->image()
                                ->collection('banner_mobile'),
                            TextInput::make('title')
                                ->helperText(__('optional')),
                            TextInput::make('link')
                                ->helperText(__('optional')),
                        ]),
                        Section::make([
                            Toggle::make('enable')
                                ->default(true)
                                ->onColor('success')
                                ->offColor('danger'),
                        ])->grow(false)
                    ]
                )
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
            ->defaultSort('order_column', 'desc')
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

<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Video;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Awcodes\Matinee\Matinee;
use Filament\Resources\Resource;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\VideoResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\VideoResource\RelationManagers;
use Embed\Embed;
use Exception;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Illuminate\Database\Eloquent\Model;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

    public static function form(Form $form): Form
    {
        $embed = new Embed();

        return $form
            ->schema([
                TextInput::make('title')
                    ->translatable(true, null, [
                        'id' => ['required',],
                        'en' => ['nullable',],
                    ]),
                Matinee::make('video')
                    ->showPreview()
                    ->live(onBlur: true)
                    ->required()
                    ->afterStateUpdated(function (Set $set, ?array $state) {
                        if (!$state['url']) {
                            $set('thumbnail', asset('placeholder/no-image-video.png'));
                        }

                        try {
                            $embed = new Embed();

                            $info = $embed->get($state['url']);

                            $set('thumbnail', strval($info->image));
                        } catch (Exception $e) {
                            // $set('thumbnail', null);
                        }
                    }),

                //! TODO: HIDDEN FIELD WILL NOT UPDATE, MAKE A WORKAROUND
                Toggle::make('use_custom_thumbnail')
                    ->live()
                    ->afterStateUpdated(function (Set $set, Get $get, bool $state) {
                        if (!$state) {
                            if (!$get('video')['url']) {
                                $set('thumbnail', asset('placeholder/no-image-video.png'));
                            }

                            try {
                                $embed = new Embed();

                                $info = $embed->get($get('video')['url']);

                                $set('thumbnail', strval($info->image));
                            } catch (Exception $e) {
                                // $set('thumbnail', null);
                            }
                        }
                    })
                    ->required(),
                ViewField::make('thumbnail')
                    ->view('forms.components.thumbnail')
                    ->default(asset('placeholder/no-image-video.png'))
                    ->hidden(fn(Get $get): bool => $get('use_custom_thumbnail'))
                    ->required(fn(Get $get): bool => $get('use_custom_thumbnail')),
                FileUpload::make('thumbnail_custom')
                    ->image()
                    ->hidden(fn(Get $get): bool => !$get('use_custom_thumbnail'))
                    ->required(fn(Get $get): bool => !$get('use_custom_thumbnail')),

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Grid::make()
                    ->columns(1)
                    ->schema([

                        ImageColumn::make('thumbnail')
                            ->state(function (Model $record) {
                                return $record->use_custom_thumbnail ? $record->thumbnail_custom : $record->thumbnail;
                            })


                        // ->getStateUsing(fn($state, $record) => $state ?: $record->full)
                        // ->disk(fn($state) => $state ?: null),
                        ,
                        TextColumn::make('title')
                            ->weight(FontWeight::SemiBold)
                            ->size(TextColumnSize::Large),


                    ])
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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}

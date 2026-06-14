<?php

namespace App\Filament\Resources;

use App\Enums\VideoType;
use App\Filament\Resources\VideoResource\Pages;
use App\Models\Video;
use App\Support\Localization;
use Awcodes\Matinee\Matinee;
use Embed\Embed;
use Exception;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getTranslatableLocales(): array
    {
        return Localization::locales();
    }

    public static function form(Form $form): Form
    {
        $embed = new Embed;
        $default_thumbnail = asset('placeholder/no-image-video.png');

        return $form
            ->schema([
                TextInput::make('title')
                    ->translatable(
                        true,
                        null,
                        Localization::rules(required: true),
                    ),

                Textarea::make('description')
                    ->translatable(
                        true,
                        null,
                        Localization::rules(['string', 'max:255']),
                    ),
                Select::make('type')
                    ->options(
                        VideoType::class
                    )
                    // ->selectablePlaceholder(false)
                    ->required(),

                Matinee::make('video')
                    ->showPreview()
                    ->live(onBlur: true)
                    ->required()
                    ->afterStateUpdated(function (Set $set, ?array $state) use ($default_thumbnail, $embed) {
                        if (! $state['url']) {
                            $set('thumbnail', $default_thumbnail);
                        }

                        try {
                            $embed = new Embed;

                            $info = $embed->get($state['url']);

                            $set('thumbnail', strval($info->image) ?? $default_thumbnail);
                        } catch (Exception $e) {
                            // $set('thumbnail', null);
                        }
                    }),

                // ! TODO: HIDDEN FIELD WILL NOT UPDATE, MAKE A WORKAROUND ?
                Toggle::make('use_custom_thumbnail')
                    ->live()
                    ->afterStateUpdated(function (Set $set, Get $get, bool $state) use ($default_thumbnail) {
                        if (! $state) {
                            if (! $get('video')['url']) {
                                $set('thumbnail', $default_thumbnail);
                            }

                            try {
                                $embed = new Embed;

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
                    ->hidden(fn (Get $get): bool => $get('use_custom_thumbnail'))
                    ->required(fn (Get $get): bool => ! $get('use_custom_thumbnail')),
                SpatieMediaLibraryFileUpload::make('thumbnail_custom')
                    ->panelAspectRatio(9 / 16)
                    ->image()
                    ->collection('thumbnail')
                    ->hidden(fn (Get $get): bool => ! $get('use_custom_thumbnail'))
                    ->required(fn (Get $get): bool => $get('use_custom_thumbnail')),
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
                                return $record->use_custom_thumbnail ?
                                    $record->getFirstMediaUrl('thumbnail')
                                    : $record->thumbnail;
                            })
                            ->extraImgAttributes(['class' => 'w-full aspect-video rounded'])
                            ->height('auto'),
                        TextColumn::make('title')
                            ->weight(FontWeight::SemiBold)
                            ->size(TextColumnSize::Large),
                        TextColumn::make('description')
                            ->html(),
                    ]),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->paginationPageOptions([9, 18, 27])
            ->defaultSort('id', 'desc')
            // ->modifyQueryUsing(fn(Builder $query): Builder => $query->published())
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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

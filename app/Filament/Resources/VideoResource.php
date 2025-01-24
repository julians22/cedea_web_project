<?php

namespace App\Filament\Resources;

use App\Enums\VideoType;
use Exception;
use Embed\Embed;
use Filament\Forms;
use Filament\Tables;
use App\Models\Video;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Awcodes\Matinee\Matinee;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\VideoResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use App\Filament\Resources\VideoResource\RelationManagers;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;


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
        $default_thumbnail = asset('placeholder/no-image-video.png');

        return $form
            ->schema([
                TextInput::make('title')
                    ->translatable(true, null, [
                        'id' => ['required',],
                        'en' => ['nullable',],
                    ]),

                Textarea::make('description')
                    ->translatable(true, null, [
                        'id' => ['nullable', 'string', 'max:255'],
                        'en' => ['nullable', 'string', 'max:255'],
                    ]),
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
                        if (!$state['url']) {
                            $set('thumbnail', $default_thumbnail);
                        }

                        try {
                            $embed = new Embed();

                            $info = $embed->get($state['url']);

                            $set('thumbnail', strval($info->image) ?? $default_thumbnail);
                        } catch (Exception $e) {
                            // $set('thumbnail', null);
                        }
                    }),

                //! TODO: HIDDEN FIELD WILL NOT UPDATE, MAKE A WORKAROUND ?
                Toggle::make('use_custom_thumbnail')
                    ->live()
                    ->afterStateUpdated(function (Set $set, Get $get, bool $state) use ($default_thumbnail) {
                        if (!$state) {
                            if (!$get('video')['url']) {
                                $set('thumbnail', $default_thumbnail);
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
                    ->required(fn(Get $get): bool => !$get('use_custom_thumbnail')),
                SpatieMediaLibraryFileUpload::make('thumbnail_custom')
                    ->panelAspectRatio(9 / 16)
                    ->image()
                    ->collection('thumbnail')
                    ->hidden(fn(Get $get): bool => !$get('use_custom_thumbnail'))
                    ->required(fn(Get $get): bool => $get('use_custom_thumbnail')),
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
                            ->html()
                    ])
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3
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

<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Message;
use Filament\Infolists;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use App\Filament\Resources\MessageResource\Pages;
use Filament\Infolists\Components\TextEntry;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('email'),
                TextEntry::make('type'),
                TextEntry::make('address')
                    ->columnSpanFull(),
                TextEntry::make('phone'),
                TextEntry::make('city'),
                TextEntry::make('gender'),
                TextEntry::make('age'),
                TextEntry::make('institution')
                    ->columnSpanFull(),
                TextEntry::make('visitor_size')
                    ->columnSpanFull(),
                TextEntry::make('message')
                    ->columnSpanFull(),
                TextEntry::make('proposed_date')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('subject'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted at'),
                Tables\Columns\TextColumn::make('type'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListMessages::route('/'),
            // 'create' => Pages\CreateMessage::route('/create'),
            'view' => Pages\ViewMessage::route('/{record}'),
            // 'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}

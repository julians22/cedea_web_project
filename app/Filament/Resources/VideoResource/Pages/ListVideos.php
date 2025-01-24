<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Enums\VideoType;
use App\Filament\Resources\VideoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListVideos extends ListRecords
{
    protected static string $resource = VideoResource::class;

    public function getTabs(): array
    {
        return [
            __('all') => Tab::make(),
            __('videos.type.recipe') => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', VideoType::RECIPE)),
            __('videos.type.tv') => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', VideoType::TV)),
        ];
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

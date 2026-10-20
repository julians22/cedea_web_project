<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Products\Product;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = ProductResource::class;

    /**
     * Default to the enabled tab while still listing all products first.
     *
     * @return array<string, Tab>
     */
    public function getTabs(): array
    {
        return [
            __('all') => Tab::make(__('all'))
                ->badge(fn (): int => Product::query()->count()),
            __('Enabled') => Tab::make(__('Enabled'))
                ->badge(fn (): int => Product::query()->enabled()->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query): Builder => $query->enabled()),
            __('Disabled') => Tab::make(__('Disabled'))
                ->badge(fn (): int => Product::query()->where('enable', false)->count())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query): Builder => $query->where('enable', false)),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return __('Enabled');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

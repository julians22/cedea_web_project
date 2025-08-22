<?php

namespace App\Filament\Exports;

use App\Models\Message;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class MessageExporter extends Exporter
{
    protected static ?string $model = Message::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('name'),
            ExportColumn::make('email'),
            ExportColumn::make('subject'),
            ExportColumn::make('purpose'),
            ExportColumn::make('message'),
            ExportColumn::make('created_at'),
            ExportColumn::make('type'),
            ExportColumn::make('address'),
            ExportColumn::make('phone'),
            ExportColumn::make('city'),
            ExportColumn::make('gender'),
            ExportColumn::make('age'),
            ExportColumn::make('institution'),
            ExportColumn::make('visitor_size'),
            ExportColumn::make('proposed_date'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your message export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}

<?php

namespace App\Filament\Pages;

use App\Settings\ContactSettings;
use Filament\Forms;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageContactPage extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = ContactSettings::class;

    public static function getNavigationGroup(): ?string
    {
        return __('Settings');
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Toggle::make('enable_photos'),
                Toggle::make('enable_visit_form'),
                Toggle::make('enable_inquiry_form'),
            ]);
    }
}

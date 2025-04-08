<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('contact.enable_photos', true);
        $this->migrator->add('contact.enable_visit_form', true);
        $this->migrator->add('contact.enable_inquiry_form', true);
    }
};

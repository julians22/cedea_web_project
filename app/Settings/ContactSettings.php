<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ContactSettings extends Settings
{
    public bool $enable_photos;
    public bool $enable_visit_form;
    public bool $enable_inquiry_form;

    public static function group(): string
    {
        return 'contact';
    }
}

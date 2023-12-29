<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class PengaturanTagSettings extends Settings
{
    public ?string $header;
    public ?string $footer;

    public static function group(): string
    {
        return 'pengaturan';
    }
}
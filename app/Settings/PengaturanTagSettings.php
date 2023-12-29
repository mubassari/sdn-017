<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class PengaturanTagSettings extends Settings
{
    public int $header;
    public int $footer;

    public static function group(): string
    {
        return 'pengaturan';
    }
}
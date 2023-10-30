<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SosmedSekolahSettings extends Settings
{
    public string $facebook;
    public string $instagram;
    public string $tiktok;
    public string $twitter;

    public static function group(): string
    {
        return 'sekolah';
    }
}
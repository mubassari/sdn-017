<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class LokasiSekolahSettings extends Settings
{
    public string $latitude;
    public string $longitude;

    public static function group(): string
    {
        return 'lokasi';
    }
}
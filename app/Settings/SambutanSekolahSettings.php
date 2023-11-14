<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SambutanSekolahSettings extends Settings
{  
    public string $isi;
    public string $kepala_sekolah_id;

    public static function group(): string
    {
        return 'sambutan';
    }
}
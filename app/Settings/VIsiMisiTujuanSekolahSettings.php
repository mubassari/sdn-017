<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class VisiMisiTujuanSekolahSettings extends Settings
{  
    public string $visi;
    public array $misi;
    public array $tujuan;

    public static function group(): string
    {
        return 'sekolah';
    }
}
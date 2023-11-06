<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SekolahSettings extends Settings
{  
    public string $nama;
    public string $logo;
    public string $ikon;
    public string $npsn;
    public string $nss;
    public string $alamat;
    public string $telepon;
    public string $email;

    public static function group(): string
    {
        return 'umum';
    }
}
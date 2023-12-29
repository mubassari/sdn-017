<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class PengaturanArtikelSettings extends Settings
{
    public int $max_artikel_terbaru;
    public int $max_artikel_terkait;
    public int $max_artikel_kategori;
    public int $max_artikel_pencarian;

    public static function group(): string
    {
        return 'pengaturan';
    }
}
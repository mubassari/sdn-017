<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('umum.nama', 'Nama umum');
        $this->migrator->add('umum.logo', '/gambar/default-sekolah.png');
        $this->migrator->add('umum.ikon', '/gambar/default-sekolah.png');
        $this->migrator->add('umum.npsn', '');
        $this->migrator->add('umum.nss', '');
        $this->migrator->add('umum.alamat', '');
        $this->migrator->add('umum.telepon', '');
        $this->migrator->add('umum.email', '');
    }
};

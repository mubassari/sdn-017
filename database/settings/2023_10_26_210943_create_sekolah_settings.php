<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('sekolah.nama', 'Nama Sekolah');
        $this->migrator->add('sekolah.logo', '/gambar/default-sekolah.png');
        $this->migrator->add('sekolah.ikon', '/gambar/default-sekolah.png');
        $this->migrator->add('sekolah.npsn', '');
        $this->migrator->add('sekolah.nss', '');
        $this->migrator->add('sekolah.alamat', '');
        $this->migrator->add('sekolah.telepon', '');
        $this->migrator->add('sekolah.email', '');
    }
};

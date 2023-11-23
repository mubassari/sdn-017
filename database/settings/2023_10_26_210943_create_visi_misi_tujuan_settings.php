<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('sekolah.visi', "");
        $this->migrator->add('sekolah.misi', []);
        $this->migrator->add('sekolah.tujuan', []);
    }
};

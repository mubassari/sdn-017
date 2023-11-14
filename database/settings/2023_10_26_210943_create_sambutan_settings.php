<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('sambutan.isi', '');
        $this->migrator->add('sambutan.kepala_sekolah_id', '1');
    }
};

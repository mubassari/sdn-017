<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('lokasi.latitude', '0');
        $this->migrator->add('lokasi.longitude', '0');
    }
};

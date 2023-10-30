<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('sekolah.facebook', '');
        $this->migrator->add('sekolah.instagram', '');
        $this->migrator->add('sekolah.tiktok', '');
        $this->migrator->add('sekolah.twitter', '');
    }
};

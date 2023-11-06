<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('sosmed.facebook', '');
        $this->migrator->add('sosmed.instagram', '');
        $this->migrator->add('sosmed.tiktok', '');
        $this->migrator->add('sosmed.twitter', '');
    }
};

<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('pengaturan.header', '');
        $this->migrator->add('pengaturan.footer', '');
    }
};

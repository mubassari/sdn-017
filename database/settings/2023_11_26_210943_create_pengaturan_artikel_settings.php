<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('pengaturan.max_artikel_terbaru', 4);
        $this->migrator->add('pengaturan.max_artikel_terkait', 4);
        $this->migrator->add('pengaturan.max_artikel_kategori', 12);
        $this->migrator->add('pengaturan.max_artikel_pencarian', 12);
    }
};

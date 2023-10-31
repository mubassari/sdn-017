<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArtikelKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('artikel_kategori')->delete();
        
        \DB::table('artikel_kategori')->insert(array (
            0 => 
            array (
                'id'   => 1,
                'nama' => 'Pengumuman',
                'slug' => 'pengumuman',
            ),
            1 => 
            array (
                'id'   => 2,
                'nama' => 'Berita',
                'slug' => 'berita',
            ),
        ));
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('kategori')->delete();
        
        \DB::table('kategori')->insert(array (
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

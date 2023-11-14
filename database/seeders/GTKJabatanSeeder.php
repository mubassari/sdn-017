<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GTKJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('gtk_jabatan')->delete();
        
        \DB::table('gtk_jabatan')->insert(array (
            0 => 
            array (
                'id'   => 1,
                'nama' => 'Kepala Sekolah',
                'foto' => '/gambar/default-person.png',
                'slug' => 'kepala-sekolah',
            ),
        ));
    }
}

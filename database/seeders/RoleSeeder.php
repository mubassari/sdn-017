<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('role')->delete();
        
        \DB::table('role')->insert(array (
            0 => 
            array (
                'id'   => 1,
                'nama' => 'Penulis',
                'slug' => 'penulis',
            ),
            1 => 
            array (
                'id'   => 2,
                'nama' => 'Admin GTK',
                'slug' => 'admin-gtk',
            ),
            2 => 
            array (
                'id'   => 3,
                'nama' => 'Admin',
                'slug' => 'admin',
            ),
            3 => 
            array (
                'id'   => 4,
                'nama' => 'Super Admin',
                'slug' => 'super-admin',
            ),
        ));
    }
}

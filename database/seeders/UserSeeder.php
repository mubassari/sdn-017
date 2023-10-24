<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $faker->seed(1234);
        for ($i = 0; $i < 15; $i++) {
            $nama = $i < 1 ? 'Admin' : ($i < 2 ? 'Iva' :  $faker->firstName);
            User::create([
                'nama' => $nama,
                'alamat' => $faker->address,
                'telpon' => $faker->bothify('08##########'),
                'password' => bcrypt('1234'),
            ]);
        }
    }
}

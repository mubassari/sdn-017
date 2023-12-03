<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
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
            $username = $i < 1 ? 'admin' : ($i < 2 ? 'iva' :  $faker->userName);
            User::create([
                'username' => $username,
                'password' => bcrypt('1234'),
            ]);
            if ($i < 1) {
                UserRole::create([
                    'user_id' => 1,
                    'role_id' => 4
                ]);
            }
        }
    }
}

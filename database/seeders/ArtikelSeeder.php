<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Artikel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        foreach(Kategori::all() as $kategori){ // loop through all kategoris 
            for ($i = 0; $i < 11; $i++) {
                $paragraph = '';
                $paragraph_length = rand(10, 20);

                for ($p = 0; $p < $paragraph_length; $p++) {
                    $paragraph .= "<p>".$faker->realText(rand(100, 200))."</p>";
                }

                $judul = $faker->realText(50);
                $post  = $paragraph;

                Artikel::create([
                    'judul'       => $judul,
                    'isi'         => $post,
                    'slug'        => Str::slug($judul),
                    'kategori_id' => $kategori->id
                ]);
            }
        }   
    }
}

<?php

namespace Database\Seeders;

use App\Models\Artikel;
use App\Models\ArtikelKategori;
use App\Models\Gambar;
use App\Models\GambarArtikel;
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

        foreach(ArtikelKategori::all() as $kategori){ // loop through all kategoris 
            for ($i = 0; $i < 17; $i++) {
                $src = "https://placekitten.com/" . rand(200, 500) . "/" . rand(200, 500);
                $paragraph = "<img src='" . $src . "'/>";
                $paragraph_length = rand(20, 30);

                for ($p = 0; $p < $paragraph_length; $p++) {
                    $paragraph .= "<p>".$faker->realText(rand(250, 500))."</p>";
                }

                $judul = $faker->realText(50);
                $post  = $paragraph;

                Artikel::create([
                    'judul'       => $judul,
                    'isi'         => $post,
                    'slug'        => Str::slug($judul),
                    'user_id'     => 1,
                    'artikel_kategori_id' => $kategori->id
                ]);
            }
        }   
    }
}

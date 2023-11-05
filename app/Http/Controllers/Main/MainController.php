<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArtikelKategori;
use Inertia\Inertia;

class MainController extends Controller
{
    public function beranda()
    {
        $list_kategori = ArtikelKategori::select('id', 'nama', 'slug')->get()->map(function($kategori) {
            return [
                'id'      => $kategori->id,
                'nama'    => $kategori->nama,
                'slug'    => $kategori->slug,
                'artikel' => $kategori->LatestArtikel(4)->map(function($data) use ($kategori) {
                    return [
                        'id'       => $data->id,
                        'judul'    => $data->judul,
                        'sampul'   => $data->path_sampul,
                        'kategori' => $kategori->nama,
                        'slug'     => $data->slug,
                        'waktu'    => $data->waktu,
                    ];
                }),
            ];
        });

        return Inertia::render('Main/Index', compact('list_kategori'));
    }
}
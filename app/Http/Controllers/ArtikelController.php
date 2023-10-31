<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Artikel;
use App\Models\ArtikelKategori;
use Inertia\Inertia;

class ArtikelController extends Controller
{
    public function beranda($kategori_slug)
    {
        try {
            $kategori = ArtikelKategori::where('slug', $kategori_slug)->firstOrFail();

            $list_artikel = Artikel::select('id', 'isi', 'judul', 'slug', 'artikel_kategori_id')
                ->where('artikel_kategori_id', $kategori->id)
                ->orderBy('id', 'desc')
                ->paginate(12)
                ->through(function($data) use ($kategori) {
                    return [
                        'id'       => $data->id,
                        'judul'    => $data->judul,
                        'sampul'   => $data->path_sampul,
                        'kategori' => $kategori->nama,
                        'slug'     => $data->slug,
                        'waktu'    => $data->waktu,
                    ];
                })
                ->withQueryString();
            return Inertia::render('Artikel/Index', compact('kategori', 'list_artikel'));
        } catch (ModelNotFoundException $exception) {
            return redirect()->intended(route('index'))->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Kategori yang Anda ingin akses saat ini tidak atau belum tersedia!'
            ]);
        }
    }

    public function tampil($kategori_slug, $artikel_slug)
    {
        try {
            $artikel_find = Artikel::select('id', 'judul', 'isi', 'slug', 'artikel_kategori_id')
                ->where('slug', $artikel_slug)
                ->firstOrFail();

            $artikel = [
                'id'            => $artikel_find->id,
                'judul'         => $artikel_find->judul,
                'isi'           => $artikel_find->isi,
                'sampul'        => $artikel_find->path_sampul,
                'kategori'      => $artikel_find->ArtikelKategori->nama,
                'kategori_slug' => $artikel_find->ArtikelKategori->slug,
                'slug'          => $artikel_find->slug,
                'waktu'         => $artikel_find->waktu,
            ];

             $artikel_terkait = Artikel::inRandomOrder()
                ->select('id', 'judul', 'isi', 'slug', 'artikel_kategori_id')
                ->where('id', '!=', $artikel_find->id) // Exclude the current article
                ->limit(4) // Limit the number of related articles
                ->get()->map(function ($artikel_find) {
                    return [
                        'id'            => $artikel_find->id,
                        'judul'         => $artikel_find->judul,
                        'isi'           => $artikel_find->isi,
                        'sampul'        => $artikel_find->path_sampul,
                        'kategori'      => $artikel_find->ArtikelKategori->nama,
                        'kategori_slug' => $artikel_find->ArtikelKategori->slug,
                        'slug'          => $artikel_find->slug,
                        'waktu'         => $artikel_find->waktu,
                    ];
                });

            return Inertia::render('Artikel/Tampil', compact('artikel', 'artikel_terkait'));
        } catch (ModelNotFoundException $exception) {
            return redirect()->intended(route('index'))->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Artikel yang Anda ingin akses saat ini tidak atau belum tersedia!'
            ]);
        }
    }
}

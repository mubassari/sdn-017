<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Artikel;
use App\Models\Kategori;
use Inertia\Inertia;

class ArtikelController extends Controller
{
    public function beranda($kategori_slug)
    {
        try {
            $kategori = Kategori::where('slug', $kategori_slug)->firstOrFail();

            $list_artikel = Artikel::select('id','judul', 'sampul', 'slug', 'kategori_id')
                ->where('kategori_id', $kategori->id)
                ->orderBy('id', 'desc')
                ->paginate(10)
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
            $artikel_find = Artikel::select('id', 'judul', 'isi', 'sampul', 'slug', 'kategori_id')
                ->where('slug', $artikel_slug)
                ->firstOrFail();

            $artikel = [
                'id'            => $artikel_find->id,
                'judul'         => $artikel_find->judul,
                'isi'           => $artikel_find->isi,
                'sampul'        => $artikel_find->path_sampul,
                'kategori'      => $artikel_find->kategori->nama,
                'kategori_slug' => $kategori_slug,
                'slug'          => $artikel_find->slug,
                'waktu'         => $artikel_find->waktu,
            ];

            return Inertia::render('Artikel/Tampil', compact('artikel'));
        } catch (ModelNotFoundException $exception) {
            return redirect()->intended(route('index'))->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Artike yang Anda ingin akses saat ini tidak atau belum tersedia!'
            ]);
        }
    }
}

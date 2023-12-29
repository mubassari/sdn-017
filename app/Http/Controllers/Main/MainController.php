<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Artikel;
use App\Models\ArtikelKategori;
use App\Settings\PengaturanArtikelSettings; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MainController extends Controller
{
    public function beranda()
    {
        $pengaturan_artikel = new PengaturanArtikelSettings;
        $artikel_baru = Artikel::select('id', 'isi', 'judul', 'slug', 'artikel_kategori_id')
            ->take($pengaturan_artikel->max_artikel_terbaru)
            ->get()
            ->map(function ($data) {
                return [
                    'id'       => $data->id,
                    'judul'    => $data->judul,
                    'sampul'   => $data->path_sampul,
                    'kategori' => [
                        'nama' => $data->ArtikelKategori->nama,
                        'slug' => $data->ArtikelKategori->slug,
                    ],
                    'slug'     => $data->slug,
                    'waktu'    => $data->waktu,
                ];
            });


        $list_kategori = ArtikelKategori::select('id', 'nama', 'slug')
            ->get()
            ->map(function($kategori) use ($pengaturan_artikel) {
                return [
                    'id'      => $kategori->id,
                    'nama'    => $kategori->nama,
                    'slug'    => $kategori->slug,
                    'artikel' => $kategori->LatestArtikel($pengaturan_artikel->max_artikel_terkait)->map(function($data) use ($kategori) {
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

        return Inertia::render('Main/Index', compact('list_kategori', 'artikel_baru'));
    }

    public function masuk()
    {
        return Inertia::render('Auth/Masuk');
    }

    public function auth(LoginRequest $request)
    {
        DB::beginTransaction();
        try {
            $credentials = $request->validated();
            if (Auth::attempt($credentials, $request->remember)) {
                $request->session()->regenerateToken();
                DB::commit();
                return redirect()->intended(route('admin.index'))->with('alert', [
                    'status' => 'success',
                    'pesan'  => 'Anda berhasil masuk!'
                ]);
            } else {
                return redirect()->back()->onlyInput('username')->with('alert', [
                    'status' => 'danger',
                    'pesan'  => 'Username Anda salah!'
                ]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat masuk. Silakan coba lagi!'
            ]);
        }
    }

    public function keluar()
    {
        DB::beginTransaction();
        try {
            Auth::logout();
            return redirect()->route('index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda Berhasil Keluar!'
            ]);
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat keluar. Silakan coba lagi!'
            ]);
        }
    }
}

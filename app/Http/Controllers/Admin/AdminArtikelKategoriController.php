<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArtikelKategoriRequest;
use App\Models\ArtikelKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminArtikelKategoriController extends Controller
{
  public function index() {
    $list_kategori = ArtikelKategori::select('id','nama', 'slug')
        ->orderBy('id', 'desc')
        ->paginate(10)
        ->through(function ($kategori) {
            return [
                'id'     => $kategori->id,
                'nama'   => $kategori->nama,
                'slug'   => $kategori->slug,
                'forbid' => $kategori->id > 2,
            ];
        })
        ->withQueryString();
    return Inertia::render('Admin/ArtikelKategori/Index', compact('list_kategori'));
  }

  public function simpan(ArtikelKategoriRequest $request)
  {
      DB::beginTransaction();
      try {
          $validated = $request->validated();
          $kategori = ArtikelKategori::create($validated);

          $kategori->save();

          DB::commit();

          return redirect()->route('admin.artikel.kategori.index')->with('alert', [
              'status' => 'success',
              'pesan'  => 'Anda berhasil menyimpan data Kategori!'
          ]);
      } catch (\Exception $e) {
          DB::rollBack();
          return back()->withInput()->with('alert', [
              'status' => 'danger',
              'pesan'  => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi!'
          ]);
      }
  }

  public function perbarui(ArtikelKategoriRequest $request, ArtikelKategori $kategori)
  {
      $idKategori = $kategori->id;
      if($idKategori > 2) {
        DB::beginTransaction();
        try {
            $validated       = $request->validated();
            $kategori->nama   = $validated['judul'];

            $kategori->save();

            DB::commit();

            return redirect()->route('admin.artikel.kategori.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil memperbarui data Kategori!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi!'
            ]);
        }
      } else {
        return back()->withInput()->with('alert', [
          'status' => 'danger',
          'pesan'  => 'Data ini tidak dapat diubah!'
      ]);
      }
  }

  public function hapus(ArtikelKategori $kategori)
  {
      $idKategori = $kategori->id;
      if($idKategori > 2) {
        DB::beginTransaction();
        try {
            $kategori->delete();

            DB::commit();

            return redirect()->route('admin.artikel.kategori.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menghapus data Kategori!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat menghapus data. Silakan coba lagi!'
            ]);
        }
      } else {
        return back()->withInput()->with('alert', [
          'status' => 'danger',
          'pesan'  => 'Data ini tidak dapat dihapus!'
      ]);
    }
  }
}


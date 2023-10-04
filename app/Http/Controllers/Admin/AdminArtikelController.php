<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArtikelRequest;
use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AdminArtikelController extends Controller
{
    public function index(Request $request){
        $list_artikel = Artikel::select('id','judul', 'sampul', 'slug', 'kategori_id')
        ->orderBy('id', 'desc')
        ->when($request->input('cari'), function ($query, $role) {
            $query->where('artikel.judul', 'like', "%$role%");
        })
        ->paginate(10)
        ->through(function($data) {
            return [
                'id'       => $data->id,
                'judul'    => $data->judul,
                'sampul'   => $data->path_sampul,
                'kategori' => $data->kategori->nama,
                'slug'     => $data->slug,
                'waktu'    => $data->waktu,
            ];
        })
        ->withQueryString();
        return Inertia::render('Admin/Artikel/Index', compact('list_artikel'));
    }
    
    public function tambah(){
        $kategori = Kategori::select('id','nama')->get();
        return Inertia::render('Admin/Artikel/Tambah', compact('kategori'));
    }

    public function simpan(ArtikelRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $artikel = Artikel::create($validated);

            if ($request->hasFile('sampul')){
                $name_file = $request->sampul->hashName();
                if (!$request->sampul->move('img/artikel', $name_file)) {
                    return back()->withInput()->with('alert', [
                        'status' => 'danger',
                        'pesan'  => 'Terjadi kesalahan saat mengunggah gambar. Silakan coba lagi!'
                    ]);
                }

                $artikel->sampul = $name_file;
            }
            $artikel->save();

            DB::commit();

            return redirect()->route('admin.artikel.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menyimpan data Artikel!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi!'
            ]);
        }
    }

    public function ubah(Artikel $artikel)
    {
        $kategori = Kategori::select('id','nama')->get();
        $artikel = collect([$artikel])->transform(function($artikel) {
            return [
                'id'          => $artikel->id,
                'judul'       => $artikel->judul,
                'isi'         => $artikel->isi,
                'sampul'      => $artikel->path_sampul,
                'kategori_id' => $artikel->kategori_id,
            ];
        })->first();
        return Inertia::render('Admin/Artikel/Ubah', compact('artikel', 'kategori'));
    }

    public function perbarui(ArtikelRequest $request, Artikel $artikel)
    {
        DB::beginTransaction();
        try {
            $validated             = $request->validated();
            
            $artikel->judul         = $validated['judul'];
            $artikel->isi           = $validated['isi'];
            $artikel->kategori_id   = $validated['kategori_id'];

            if ($request->hasFile('sampul') && $request->file('sampul')->isValid()){
                $name_file = $request->sampul->hashName();
                if(!$request->sampul->move('img/artikel', $name_file)) {
                    return back()->withInput()->with('alert', [
                        'status' => 'danger',
                        'pesan'  => 'Terjadi kesalahan saat mengunggah gambar. Silakan coba lagi!'
                    ]);
                }

                if (Storage::exists("img/artikel/$artikel->sampul") && $artikel->sampul !== 'default.jpg' && !Storage::delete("img/artikel/$artikel->sampul")){
                    return back()->withInput()->with('alert', [
                        'status' => 'danger',
                        'pesan'  => 'Terjadi kesalahan saat menghapus gambar lama. Silakan coba lagi!'
                    ]);
                }

                $artikel->sampul = $name_file;
            }

            $artikel->save();

            DB::commit();

            return redirect()->route('admin.artikel.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil memperbarui data Artikel!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi!'
            ]);
        }
    }

    public function hapus(Artikel $artikel)
    {
        DB::beginTransaction();
        try {
            $artikel->delete();

            if (Storage::exists("img/artikel/$artikel->sampul") && $artikel->sampul !== 'default.jpg' && !Storage::delete('img/artikel/' . $artikel->sampul)) {
                return back()->withInput()->with('alert', [
                    'status' => 'danger',
                    'pesan'  => 'Terjadi kesalahan saat menghapus gambar. Silakan coba lagi!'
                ]);
            }

            DB::commit();

            return redirect()->route('admin.artikel.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menghapus data Artikel!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat menghapus data. Silakan coba lagi!'
            ]);
        }
    }
}

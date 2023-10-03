<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeritaRequest;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AdminBeritaController extends Controller
{
    public function index(Request $request){
        $list_berita = Berita::select('id','judul', 'sampul', 'slug', 'created_at')
        ->orderBy('id', 'desc')
        ->when($request->input('cari'), function ($query, $role) {
            $query->where('berita.judul', 'like', "%$role%");
        })
        ->paginate(10)
        ->through(function($data) {
            return [
                'id'     => $data->id,
                'judul'  => $data->judul,
                'sampul' => $data->path_sampul,
                'slug'   => $data->slug,
                'waktu'  => $data->waktu,
            ];
        })
        ->withQueryString();
        return Inertia::render('Admin/Berita/Index', compact('list_berita'));
    }
    
    public function tambah(){
        return Inertia::render('Admin/Berita/Tambah');
    }

    public function simpan(BeritaRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $berita = Berita::create($validated);

            if ($request->hasFile('sampul')){
                $name_file = $request->sampul->hashName();
                if (!$request->sampul->move('img/berita', $name_file)) {
                    return back()->withInput()->with('alert', [
                        'status' => 'danger',
                        'pesan'  => 'Terjadi kesalahan saat mengunggah gambar. Silakan coba lagi!'
                    ]);
                }

                $berita->sampul = $name_file;
            }
            $berita->save();

            DB::commit();

            return redirect()->route('admin.berita.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menyimpan data Berita!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi!'
            ]);
        }
    }

    public function ubah(Berita $berita)
    {
        $berita = collect([$berita])->transform(function($berita) {
            return [
                'id'     => $berita->id,
                'judul'  => $berita->judul,
                'isi'    => $berita->isi,
                'sampul' => $berita->path_sampul,
            ];
        })->first();
        return Inertia::render('Admin/Berita/Ubah', compact('berita'));
    }

    public function perbarui(BeritaRequest $request, Berita $berita)
    {
        DB::beginTransaction();
        try {
            $validated     = $request->validated();
            
            $berita->judul = $validated['judul'];
            $berita->isi   = $validated['isi'];

            if ($request->hasFile('sampul') && $request->file('sampul')->isValid()){
                $name_file = $request->sampul->hashName();
                if(!$request->sampul->move('img/berita', $name_file)) {
                    return back()->withInput()->with('alert', [
                        'status' => 'danger',
                        'pesan'  => 'Terjadi kesalahan saat mengunggah gambar. Silakan coba lagi!'
                    ]);
                }

                if (Storage::exists("img/berita/$berita->sampul") && $berita->sampul !== 'default.jpg' && !Storage::delete("img/berita/$berita->sampul")){
                    return back()->withInput()->with('alert', [
                        'status' => 'danger',
                        'pesan'  => 'Terjadi kesalahan saat menghapus gambar lama. Silakan coba lagi!'
                    ]);
                }

                $berita->sampul = $name_file;
            }

            $berita->save();

            DB::commit();

            return redirect()->route('admin.berita.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil memperbarui data Berita!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi!'
            ]);
        }
    }

    public function hapus(Berita $berita)
    {
        DB::beginTransaction();
        try {
            $berita->delete();

            if (Storage::exists("img/berita/$berita->sampul") && $berita->sampul !== 'default.jpg' && !Storage::delete('img/berita/' . $berita->sampul)) {
                return back()->withInput()->with('alert', [
                    'status' => 'danger',
                    'pesan'  => 'Terjadi kesalahan saat menghapus gambar. Silakan coba lagi!'
                ]);
            }

            DB::commit();

            return redirect()->route('admin.berita.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menghapus data Berita!'
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

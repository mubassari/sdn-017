<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GTKRequest;
use App\Models\GTK;
use App\Models\GTKJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AdminGTKController extends Controller
{
    public function index(Request $request){
        $list_gtk = GTK::select('id', 'nama', 'sampul', 'slug', 'gtk_jabatan_id')
        ->orderBy('id', 'desc')
        ->when($request->input('cari'), function ($query, $role) {
            $query->where('gtk.nama', 'like', "%$role%");
        })
        ->paginate(10)
        ->through(function($data) {
            return [
                'id'            => $data->id,
                'nama'         => $data->nama,
                'sampul'        => $data->path_sampul,
                'jabatan'      => $data->GTKJabatan->nama,
                'jabatan_slug' => $data->GTKJabatan->slug,
                'slug'          => $data->slug,
            ];
        })
        ->withQueryString();
        return Inertia::render('Admin/GTK/Index', compact('list_gtk'));
    }
    
    public function tambah(){
        $jabatan = GTKJabatan::select('id','nama')->get();
        return Inertia::render('Admin/GTK/Tambah', compact('jabatan'));
    }

    public function simpan(GTKRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $gtk = GTK::create($validated);

            if ($request->hasFile('sampul')){
                $name_file = $request->sampul->hashName();
                if (!$request->sampul->storeAs('public/gambar/gtk', $name_file)) {
                    return back()->withInput()->with('alert', [
                        'status' => 'danger',
                        'pesan'  => 'Terjadi kesalahan saat mengunggah gambar. Silakan coba lagi!'
                    ]);
                }

                $gtk->sampul = $name_file;
            }
            $gtk->save();

            DB::commit();

            return redirect()->route('admin.gtk.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menyimpan data GTK!'
            ]);
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi!'
            ]);
        }
    }

    public function ubah(GTK $gtk)
    {
        $jabatan = GTKJabatan::select('id','nama')->get();
        $gtk = collect([$gtk])->transform(function($gtk) {
            return [
                'id'          => $gtk->id,
                'nama'       => $gtk->nama,
                'isi'         => $gtk->isi,
                'sampul'      => $gtk->path_sampul,
                'gtk_jabatan_id' => $gtk->gtk_jabatan_id,
            ];
        })->first();
        return Inertia::render('Admin/GTK/Ubah', compact('gtk', 'jabatan'));
    }

    public function perbarui(GTKRequest $request, GTK $gtk)
    {
        DB::beginTransaction();
        try {
            $validated             = $request->validated();
            
            $gtk->nama         = $validated['nama'];
            $gtk->isi           = $validated['isi'];
            $gtk->gtk_jabatan_id   = $validated['gtk_jabatan_id'];

            if ($request->hasFile('sampul') && $request->file('sampul')->isValid()){
                $name_file = $request->sampul->hashName();
                if(!$request->sampul->storeAs('public/gambar/gtk', $name_file)) {
                    return back()->withInput()->with('alert', [
                        'status' => 'danger',
                        'pesan'  => 'Terjadi kesalahan saat mengunggah gambar. Silakan coba lagi!'
                    ]);
                }

                if (Storage::exists("public/gambar/gtk/$gtk->sampul") && $gtk->sampul !== 'default.png' && !Storage::delete("public/gambar/gtk/$gtk->sampul")){
                    return back()->withInput()->with('alert', [
                        'status' => 'danger',
                        'pesan'  => 'Terjadi kesalahan saat menghapus gambar lama. Silakan coba lagi!'
                    ]);
                }

                $gtk->sampul = $name_file;
            }

            $gtk->save();

            DB::commit();

            return redirect()->route('admin.gtk.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil memperbarui data GTK!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi!'
            ]);
        }
    }

    public function hapus(GTK $gtk)
    {
        DB::beginTransaction();
        try {
            $gtk->delete();

            if (Storage::exists("public/gambar/gtk/$gtk->sampul") && $gtk->sampul !== 'default.png' && !Storage::delete('public/gambar/gtk/' . $gtk->sampul)) {
                return back()->withInput()->with('alert', [
                    'status' => 'danger',
                    'pesan'  => 'Terjadi kesalahan saat menghapus gambar. Silakan coba lagi!'
                ]);
            }

            DB::commit();

            return redirect()->route('admin.gtk.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menghapus data GTK!'
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

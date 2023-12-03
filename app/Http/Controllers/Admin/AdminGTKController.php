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
        $list_gtk = GTK::select('id', 'nip', 'nama', 'foto', 'status', 'slug', 'gtk_jabatan_id')
        ->orderBy('id', 'desc')
        ->when($request->input('cari'), function ($query, $role) {
            $query->where('gtk.nama', 'like', "%$role%");
        })
        ->paginate(10)
        ->through(function($data) {
            return [
                'id'            => $data->id,
                'nama'         => $data->nama,
                'nip'         => $data->nip,
                'foto'        => $data->path_foto,
                'status'        => $data->status,
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
            $validated['foto'] = '/gambar/default-person.png';
            $gtk = GTK::create($validated);

            if ($request->hasFile('foto')){
                $name_file = $request->foto->hashName();
                if (!$request->foto->storeAs('public/gambar/gtk', $name_file)) {
                    return back()->withInput()->with('alert', [
                        'status' => 'danger',
                        'pesan'  => 'Terjadi kesalahan saat mengunggah gambar. Silakan coba lagi!'
                    ]);
                }
                $gtk->foto = $name_file;
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
                'nip'       => $gtk->nip,
                'tempat_lahir'       => $gtk->tempat_lahir,
                'tanggal_lahir'       => $gtk->tanggal_lahir,
                'jenis_kelamin'       => $gtk->jenis_kelamin,
                'status'         => $gtk->status,
                'foto'      => $gtk->path_foto,
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
            $gtk->nip         = $validated['nip'];
            $gtk->tempat_lahir = $validated['tempat_lahir'];
            $gtk->tanggal_lahir = $validated['tanggal_lahir'];
            $gtk->jenis_kelamin = $validated['jenis_kelamin'];
            $gtk->status   = $validated['status'];
            $gtk->gtk_jabatan_id   = $validated['gtk_jabatan_id'];

            if ($request->hasFile('foto') && $request->file('foto')->isValid()){
                $name_file = $request->foto->hashName();
                if(!$request->foto->storeAs('public/gambar/gtk', $name_file)) {
                    return back()->withInput()->with('alert', [
                        'status' => 'danger',
                        'pesan'  => 'Terjadi kesalahan saat mengunggah gambar. Silakan coba lagi!'
                    ]);
                }

                if (Storage::exists("public/gambar/gtk/$gtk->foto") && $gtk->foto !== '/gambar/default-person.png' && !Storage::delete("public/gambar/gtk/$gtk->foto")){
                    return back()->withInput()->with('alert', [
                        'status' => 'danger',
                        'pesan'  => 'Terjadi kesalahan saat menghapus gambar lama. Silakan coba lagi!'
                    ]);
                }

                $gtk->foto = $name_file;
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

            if (Storage::exists("public/gambar/gtk/$gtk->foto") && $gtk->foto !== '/gambar/default-person.png' && !Storage::delete('public/gambar/gtk/' . $gtk->foto)) {
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

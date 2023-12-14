<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GTKJabatanRequest;
use App\Models\GTKJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminGTKJabatanController extends Controller
{
  public function index() {
    $list_jabatan = GTKJabatan::select('id','nama', 'slug')
        ->orderBy('id', 'desc')
        ->paginate(10)
        ->through(function ($jabatan) {
            return [
                'id'     => $jabatan->id,
                'nama'   => $jabatan->nama,
                'slug'   => $jabatan->slug,
                'is_kepsek' => $jabatan->id == 1
            ];
        })
        ->withQueryString();
    return Inertia::render('Admin/GTKJabatan/Index', compact('list_jabatan'));
  }

  public function simpan(GTKJabatanRequest $request)
  {
      try {
        DB::beginTransaction();
        $validated = $request->validated();
        $jabatan = GTKJabatan::create($validated);

        $jabatan->save();

        DB::commit();

        return redirect()->route('admin.gtk.jabatan.index')->with('alert', [
            'status' => 'success',
            'pesan'  => 'Anda berhasil menyimpan data Jabatan!'
        ]);
      } catch (\Exception $e) {
          DB::rollBack();
          return back()->withInput()->with('alert', [
              'status' => 'danger',
              'pesan'  => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi!'
          ]);
      }
  }

  public function perbarui(GTKJabatanRequest $request, GTKJabatan $jabatan)
  {
    if($jabatan->id != 1) {
        DB::beginTransaction();
        try {
            $validated       = $request->validated();
            $jabatan->nama   = $validated['nama'];

            $jabatan->save();

            DB::commit();

            return redirect()->route('admin.gtk.jabatan.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil memperbarui data Jabatan!'
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

  public function hapus(GTKJabatan $jabatan)
  {
    DB::beginTransaction();
    if ($jabatan->id != 1) {
        try {
            $jabatan->delete();

            DB::commit();

            return redirect()->route('admin.gtk.jabatan.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menghapus data Jabatan!'
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


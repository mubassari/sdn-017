<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\SambutanSekolahSettingsRequest;
use App\Settings\SambutanSekolahSettings;

use App\Models\GTK;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AdminSekolahSambutanController extends Controller
{
    public function index(){
        $sambutan  = new SambutanSekolahSettings();
        $id_kepala_sekolah = GTK::select('id', 'nama', 'gtk_jabatan_id')
            ->where('gtk_jabatan_id', '=', 1)
            ->get();
        return Inertia::render('Admin/Sambutan/Index', compact('sambutan', 'id_kepala_sekolah'));
    }

    public function simpan(SambutanSekolahSettingsRequest $request, SambutanSekolahSettings $sambutan)
    {  
        DB::beginTransaction();
        try {
            $sambutan->fill($request->validated());
            $sambutan->save();

            DB::commit();

            return redirect()->route('admin.sambutan.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menyimpan data Sambutan Kepala Sekolah!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi!'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\VisiSekolahSettingsRequest;
use App\Http\Requests\MisiSekolahSettingsRequest;
use App\Http\Requests\TujuanSekolahSettingsRequest;
use App\Settings\VisiMisiTujuanSekolahSettings;

use App\Models\GTK;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AdminSekolahVisiMisiTujuanController extends Controller
{
    public function index(){
        $visi_misi_tujuan  = new VisiMisiTujuanSekolahSettings();
        return Inertia::render('Admin/VisiMisiTujuan/Index', compact('visi_misi_tujuan'));
    }

    public function simpanVisi(VisiSekolahSettingsRequest $request, VisiMisiTujuanSekolahSettings $visi_misi_tujuan)
    {  
        DB::beginTransaction();
        try {
            $visi_misi_tujuan->visi = $request->content;

            $visi_misi_tujuan->save();

            DB::commit();

            return redirect()->route('admin.visi_misi_tujuan.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menyimpan data Visi Sekolah!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi!'
            ]);
        }
    }

    public function simpanMisi(MisiSekolahSettingsRequest $request, VisiMisiTujuanSekolahSettings $visi_misi_tujuan)
    {  
        DB::beginTransaction();
        try {
            $visi_misi_tujuan->misi = array_values(array_filter($request->content, function($value) {
                return $value !== null;
            }));

            $visi_misi_tujuan->save();

            DB::commit();

            return redirect()->route('admin.visi_misi_tujuan.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menyimpan data Misi Sekolah!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi!'
            ]);
        }
    }

    public function simpanTujuan(TujuanSekolahSettingsRequest $request, VisiMisiTujuanSekolahSettings $visi_misi_tujuan)
    {  
        DB::beginTransaction();
        try {
            $visi_misi_tujuan->tujuan = array_values(array_filter($request->content, function($value) {
                return $value !== null;
            }));

            $visi_misi_tujuan->save();

            DB::commit();

            return redirect()->route('admin.visi_misi_tujuan.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menyimpan data Tujuan Sekolah!'
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Settings\PengaturanArtikelSettings; 
use App\Http\Requests\PengaturanArtikelSettingsRequest;

use App\Settings\PengaturanTagSettings; 
use App\Http\Requests\PengaturanTagSettingsRequest;

use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminPengaturanController extends Controller
{
    public function index()
    {
        $artikel = new PengaturanArtikelSettings();
        $tag     = new PengaturanTagSettings();
        return Inertia::render('Admin/Pengaturan/Index', compact('artikel', 'tag'));
    }

    public function simpan_artikel(PengaturanArtikelSettingsRequest $request, PengaturanArtikelSettings $artikel)
    {
        DB::beginTransaction();
        try {
            $artikel->fill($request->validated());
            $artikel->save();

            DB::commit();

            return redirect()->route('admin.pengaturan.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menyimpan Pengaturan Artikel!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi!'
            ]);
        }
    }

    public function simpan_tag(PengaturanTagSettingsRequest $request, PengaturanTagSettings $tag)
    {
        DB::beginTransaction();
        try {
            $tag->fill($request->validated());
            $tag->save();

            DB::commit();

            return redirect()->route('admin.pengaturan.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menyimpan Pengaturan Tag!'
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

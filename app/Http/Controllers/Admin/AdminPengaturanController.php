<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Settings\PengaturanArtikelSettings; 
use App\Http\Requests\PengaturanArtikelSettingsRequest;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminPengaturanController extends Controller
{
    public function index()
    {
        $artikel  = new PengaturanArtikelSettings();
        return Inertia::render('Admin/Pengaturan/Index', compact('artikel'));
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
}

<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\GTK;
use App\Settings\SambutanSekolahSettings;
use Inertia\Inertia;

class MainSekolahController extends Controller
{
    public function tentang() {

    }

    public function sambutan() {
        $sambutan       = new SambutanSekolahSettings();
        $kepala_sekolah = GTK::select('id', 'nama', 'foto', 'gtk_jabatan_id')
            ->where('id', '=', $sambutan->kepala_sekolah_id)
            ->first();
        
        if ($kepala_sekolah !== null) {
            $kepala_sekolah->foto = $kepala_sekolah->path_foto;

            return Inertia::render('Main/Sekolah/Sambutan', compact('sambutan', 'kepala_sekolah'));
        } else {
            return redirect()->intended(route('index'))->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Halaman yang Anda ingin akses saat ini tidak atau belum tersedia!'
            ]);
        }
    }

    public function visi_misi_tujuan() {
        return Inertia::render('Main/Sekolah/VisiMisiTujuan');
    }
}

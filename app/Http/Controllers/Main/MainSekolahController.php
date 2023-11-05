<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainSekolahController extends Controller
{
    public function tentang() {

    }

    public function sambutan() {

    }

    public function visi_misi_tujuan() {
        return Inertia::render('Main/Sekolah/VisiMisiTujuan');
    }
}

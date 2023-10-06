<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ArtikelController extends Controller
{
    public function beranda()
    {
        return Inertia::render('Artikel/Index');
    }

    public function tampil()
    {
        return Inertia::render('Artikel/Index');
    }
}

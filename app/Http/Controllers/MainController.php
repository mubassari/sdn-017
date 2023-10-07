<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Inertia\Inertia;

class MainController extends Controller
{
    public function beranda()
    {
        $list_kategori = Kategori::latest();
        return Inertia::render('Index');
    }
}

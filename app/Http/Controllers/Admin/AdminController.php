<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function beranda()
    {
        // $list_indikator = Indikator::latest()->get()->map(function ($indikator) {
        //     $indikator->path_foto = $indikator->getPathFotoAttribute();
        //     $indikator->isi       = \Str::limit($indikator->isi, 250, '...');

        //     return $indikator;
        // });
        // return Inertia::render('Beranda', compact('list_indikator'));

        return Inertia::render('Tes', ['user'=>['name'=>'hello']]);
    }
}

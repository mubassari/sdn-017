<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    public function beranda()
    {
        return Inertia::render('Index');
    }
}

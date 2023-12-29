<?php

namespace App\Http\Controllers\Main;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use Spatie\Sitemap\SitemapGenerator;

class SitemapController extends Controller
{
    public function index()
    {
        // SitemapGenerator::create('https://kawankoding.id')->executeJavaScript()->getSitemap()->writeToDisk('public', 'sitemap.xml');
        $sitemap = collect([
            collect([
                'route' => route('index'),
                'date' => Carbon::today()
            ]),
            collect([
                'route' => route('visi_misi_tujuan'),
                'date' => Carbon::today()
            ]),
            collect([
                'route' => route('sambutan'),
                'date' => Carbon::today()
            ]),
            collect([
                'route' => route('gtk'),
                'date' => Carbon::today()
            ]),
            collect([
                'route' => route('tentang'),
                'date' => Carbon::today()
            ]),
        ]);

        \App\Models\ArtikelKategori::select('id', 'nama', 'slug')
            ->get()
            ->map(function($kategori) use ($sitemap) {
                $sitemap->push(
                    collect([
                        'route' => route('artikel.index', $kategori->slug),
                        'date' => Carbon::today()
                    ])
                );

                $kategori->Artikel->map(function($artikel) use ($kategori, $sitemap) {
                    $sitemap->push(
                        collect([
                            'route' => route('artikel.tampil', [$kategori->slug, $artikel->slug]),
                            'date' => $artikel->updated_at->tz('UTC')->toAtomString()
                        ])
                    );
                });
            });

            // dd($sitemap);

        return response()->view('sitemap', compact('sitemap'))->header('Content-Type', 'text/xml');
    }
}

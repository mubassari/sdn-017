<?php

namespace App\Http\Middleware;

use App\Models\ArtikelKategori;
use App\Settings\SekolahSettings;
use App\Settings\SosmedSekolahSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $isAdminPage = Str::startsWith($request->route()->getName(), 'admin.');

        return array_merge(parent::share($request), [
            'page_content' => $isAdminPage ? NULL : [
                'list_kategori' => ArtikelKategori::select('id','nama', 'slug')->get()
            ],
            'alert'    => session('alert'),
            'sekolah'  => [
                'umum'   => new SekolahSettings,
                'sosmed' => new SosmedSekolahSettings,
            ],
            'is_auth' => Auth::user(),
            'scroll_position' => session('scroll_position'),
        ]);
    }
}

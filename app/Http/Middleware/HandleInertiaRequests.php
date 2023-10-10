<?php

namespace App\Http\Middleware;

use App\Models\Kategori;
use Illuminate\Http\Request;
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
            'page_content' => $isAdminPage ?  [] : [
                'list_kategori' => Kategori::select('id','nama', 'slug')->get()
            ],
            'alert'    => session('alert')
        ]);
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Carbon\Carbon::setLocale('id');
        date_default_timezone_set('Asia/Makassar');
        setlocale(LC_TIME, 'id_ID');
        \Illuminate\Support\Facades\View::share('settings', new \App\Settings\PengaturanTagSettings());
    }
}

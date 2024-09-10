<?php

namespace App\Providers;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        view()->share('jumlah_sigendis',
                DB::table('booking_header')
                        ->where('status',0)
                        ->count('id'));

        view()->share('jumlah_artikel',
                DB::table('artikel')
                        ->where('status',0)
                        ->count('id'));
    }
}

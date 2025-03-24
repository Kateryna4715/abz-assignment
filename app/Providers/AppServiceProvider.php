<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!Session::has('csrf_token_time')) {
            Session::put('csrf_token_time', Carbon::now());
        }
    }
}

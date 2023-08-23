<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
        Paginator::useBootstrap();
        $login_status = Auth::user() ? true : false;

        // If the user is logged in, update the transient
        if ($login_status) {
          Cache::put('user_login_status', true, 60 * 60 * 12); // 12 hours
        }
    }
}

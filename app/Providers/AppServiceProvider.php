<?php

namespace App\Providers;

use App\Http\Controllers\BasketController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;


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
        //
        if ($this->app->isLocal()) {
            URL::forceScheme('http');
            } else {
            URL::forceScheme('https');
        }

        if (!Session::has('basket_qty')) {
            Session::put('basket_qty', 0);
        }

        // Paginator::useBootstrap();
    }
}

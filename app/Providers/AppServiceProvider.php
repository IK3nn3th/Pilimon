<?php

namespace App\Providers;

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
       // Paginator::defaultView('pagination-bulma::bulma');
        Paginator::defaultSimpleView('pagination-bulma::bulma-simple');
        Schema::defaultStringLength(191);
    }
}

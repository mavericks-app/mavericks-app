<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {


        Gate::define('viewApiDocs', function ($user = null) {
            // Permite el acceso a todos, usuarios logueados o no a la doc
            return true;
        });

    }
}

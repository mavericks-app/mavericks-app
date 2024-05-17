<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use App\api\core\users\application\Users;
use App\api\core\users\infrastructure\UserGuard;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class UserService extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Users::class, function (Application $app) {
            return new Users(new UserGuard());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

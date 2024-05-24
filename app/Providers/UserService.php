<?php

namespace App\Providers;

use App\api\core\users\infrastructure\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use App\api\core\users\application\Users;
use App\api\core\users\infrastructure\UserGuard;
use App\Models\User as UserApp;
use Illuminate\Support\ServiceProvider;
use App\api\core\users\domain\User;

class UserService extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Registrar UserRepository
        $this->app->bind(UserRepository::class, function (Application $app) {
            return new UserRepository(
                $app->make(UserApp::class),
                $app->make(User::class)
            );
        });

        // Registrar Users singleton, asegurando que las dependencias se resuelvan adecuadamente
        $this->app->singleton(Users::class, function (Application $app) {
            return new Users(
                $app->make(UserGuard::class), // Resolver UserGuard
                $app->make(UserRepository::class) // Resolver UserRepository correctamente
            );
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

<?php

namespace App\Providers;
use App\api\core\shared\contracts\domain\RepositoryBD;
use App\api\core\shared\contracts\infrastructure\EloquentRepository;
use App\api\core\users\infrastructure\UserRepository;
use App\api\models\infrastructure\ModelRepository;
use Illuminate\Support\ServiceProvider;

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


    }
}

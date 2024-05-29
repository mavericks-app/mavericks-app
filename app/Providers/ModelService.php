<?php

namespace App\Providers;

use App\api\models\infrastructure\ModelRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\api\models\application\Models;
use App\Models\Model as ModelApp;
use App\api\models\domain\Model as ModelDomain;


class ModelService extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->bind(ModelRepository::class, function (Application $app) {
            return new ModelRepository(
                $app->make(ModelApp::class),
                $app->make(ModelDomain::class)
            );
        });


        $this->app->bind(Models::class, function (Application $app) {
            return new Models(
                $app->make(ModelRepository::class)
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

<?php

namespace App\Providers;

use App\api\agencies\infrastructure\AgencyRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\api\agencies\application\Agencies;
use App\Models\Agency as ModelLaravel;
use App\api\agencies\domain\Agency as ModelDomain;


class AgenciesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->bind(AgencyRepository::class, function (Application $app) {
            return new AgencyRepository(
                $app->make(ModelLaravel::class),
                $app->make(ModelDomain::class)
            );
        });


        $this->app->bind(Agencies::class, function (Application $app) {
            return new Agencies(
                $app->make(AgencyRepository::class)
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

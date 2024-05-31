<?php

namespace App\Providers;

use App\api\templates\infrastructure\TemplateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\api\templates\application\Templates;
use App\Models\Template;
use App\api\templates\domain\Template as ModelDomain;


class TemplateService extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->bind(TemplateRepository::class, function (Application $app) {
            return new TemplateRepository(
                $app->make(Template::class),
                $app->make(ModelDomain::class)
            );
        });


        $this->app->bind(Templates::class, function (Application $app) {
            return new Templates(
                $app->make(TemplateRepository::class)
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

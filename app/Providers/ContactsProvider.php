<?php

namespace App\Providers;

use App\api\contacts\infrastructure\ContactRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\api\contacts\application\Contacts;
use App\Models\Contact as ModelLaravel;
use App\api\contacts\domain\Contact as ModelDomain;


class ContactsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->bind(ContactRepository::class, function (Application $app) {
            return new ContactRepository(
                $app->make(ModelLaravel::class),
                $app->make(ModelDomain::class)
            );
        });


        $this->app->bind(Contacts::class, function (Application $app) {
            return new Contacts(
                $app->make(ContactRepository::class)
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

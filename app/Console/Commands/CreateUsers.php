<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CreateUsers extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:users {count=1000} : The number of users to create';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear usuarios aleatorios utilizando la factoría';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = (int) $this->argument('count');

        $userRole = Role::where('name', UserRole::User)->first();

        for ($i = 0; $i < $count; $i++) {
            $user=User::factory()->create();
            $user->assignRole($userRole);
        }

        $this->info("Se han creado {$count} usuarios.");
    }
}

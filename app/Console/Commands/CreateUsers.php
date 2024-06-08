<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

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
        User::factory()->count($count)->create();

        $this->info("Se han creado {$count} usuarios.");
    }
}

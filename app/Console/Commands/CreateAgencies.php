<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Agency;
class CreateAgencies extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:agencies {count=1000} : The number of agencies to create';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear agencias aleatorias utilizando la factoría';

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
        $count = $this->argument('count');

        Agency::factory()->count($count)->create();

        $this->info("Se han creado {$count} agencias.");
    }
}

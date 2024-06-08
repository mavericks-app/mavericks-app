<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contact;

class CreateContacts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:contacts {count=1000 : The number of contacts to create}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear contactos aleatorios utilizando la factoría';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = $this->argument('count');

        Contact::factory()->count($count)->create();

        $this->info("Se han creado {$count} contactos.");

        return 0;
    }
}


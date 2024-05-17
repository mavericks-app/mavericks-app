<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;



class Deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy';




    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy app';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call("migrate");
        $this->info(Artisan::output());
        Artisan::call("config:cache");
        $this->info(Artisan::output());
        Artisan::call("event:cache");
        $this->info(Artisan::output());
        Artisan::call("route:cache");
        $this->info(Artisan::output());
        Artisan::call("optimize");
        $this->info(Artisan::output());
        Artisan::call("optimize:clear");
        $this->info(Artisan::output());

    }
}

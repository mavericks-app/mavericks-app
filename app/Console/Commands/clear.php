<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class clear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear cache';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call("view:clear");
        $this->info(Artisan::output());
        Artisan::call("cache:clear");
        $this->info(Artisan::output());
        Artisan::call("route:clear");
        $this->info(Artisan::output());

    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;



// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $role = Role::create(['guard_name' => 'api','name' => 'admin']);

        $user=User::factory()->create([
            'name' => 'admin',
            'email' => 'info@mavericks.com',
            'password' => "mavericks"
        ]);

        $user->assignRole($role);



    }
}

<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Agency;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::truncate();  // Esto elimina todos los registros en la tabla users
        Role::truncate();

        //Creamos roles
        $roleSuperAdmin = Role::create(['name' => UserRole::SuperAdmin]);
        $roleAdmin = Role::create(['name' => UserRole::Admin]);
        $roleUser = Role::create(['name' => UserRole::User]);
        $roleClient = Role::create(['name' => UserRole::Client]);

        $agency=Agency::factory()->create([
        "name"=>"Mavericks Development",
        "email"=>"info@maverickshomes.com",
        "phone"=>"966665544",
        "city"=>"Elche",
        "website"=>"https://maverickshomes.com"
        ]);

        Agency::factory()->create();

        $user=User::factory()->create([
            'name' => 'admin',
            'email' => 'info@mavericks.com',
            'password' => "mavericks",
            'agency_id' => $agency->id
        ]);

        $user->assignRole($roleSuperAdmin);

    }
}

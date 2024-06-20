<?php

namespace Database\Seeders;

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

        $roleSuperAdmin = Role::create(['guard_name' => 'api','name' => 'superadmin']);
        $roleAdmin = Role::create(['guard_name' => 'api','name' => 'admin']);
        $roleUser = Role::create(['guard_name' => 'api','name' => 'user']);

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

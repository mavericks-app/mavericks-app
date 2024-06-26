<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Enums\Permissions;


class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roleSuperAdmin = Role::where(['name' => 'superadmin'])->first();
        $roleAdmin = Role::where(['name' => 'admin'])->first();
        $roleUser = Role::where(['name' => 'user'])->first();

        Permission::firstOrCreate(['name' => Permissions::AgencyList]);
        Permission::firstOrCreate(['name' => Permissions::AgencyCreate]);
        Permission::firstOrCreate(['name' => Permissions::AgencyGet]);
        Permission::firstOrCreate(['name' => Permissions::AgencyEdit]);
        Permission::firstOrCreate(['name' => Permissions::AgencyRemove]);

        $roleSuperAdmin->syncPermissions([
            Permissions::AgencyList,
            Permissions::AgencyCreate,
            Permissions::AgencyGet,
            Permissions::AgencyEdit,
            Permissions::AgencyRemove,
        ]);

        $roleAdmin->syncPermissions([
            Permissions::AgencyGet
        ]);

    }
}

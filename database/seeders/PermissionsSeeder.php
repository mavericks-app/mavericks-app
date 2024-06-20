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

        $roleSuperAdmin = Role::where(['name' => 'superadmin']);
        $roleAdmin = Role::where(['name' => 'admin']);
        $roleUser = Role::where(['name' => 'user']);

        Permission::create(['name' => Permissions::AgencyList]);
        Permission::create(['name' => Permissions::AgencyCreate]);
        Permission::create(['name' => Permissions::AgencyEdit]);
        Permission::create(['name' => Permissions::AgencyRemove]);

        $roleSuperAdmin->syncPermissions([
            Permissions::AgencyList,
            Permissions::AgencyCreate,
            Permissions::AgencyEdit,
            Permissions::AgencyRemove,
        ]);


    }
}

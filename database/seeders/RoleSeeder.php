<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($companyId)
    {
        $role = new Role;
        $role->name = 'Manager';
        $role->company_id = $companyId;
        $role->display_name = 'Manager';
        $role->save();

        $roleId = $role->id;
        $permissions = Permission::get();

        $role = Role::findOrFail($roleId);
        $role->perms()->sync([]);
        $role->attachPermissions($permissions);

    }
}

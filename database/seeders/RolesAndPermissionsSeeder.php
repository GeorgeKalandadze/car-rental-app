<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $permissions = [
            'can_edit_company',
            'can_delete_company',
            'can_create_car_as_company_member',
            'can_edit_car_as_company_member',
            'can_delete_car_as_company_member',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = [
            'company_owner' => [
                'can_edit_company',
                'can_delete_company',
                'can_create_car_as_company_member',
                'can_edit_car_as_company_member',
                'can_delete_car_as_company_member',
            ],
            'company_admin' => [
                'can_edit_company',
                'can_create_car_as_company_member',
                'can_edit_car_as_company_member',
                'can_delete_car_as_company_member',
            ],
            'company_moderator' => [
                'can_create_car_as_company_member',
                'can_edit_car_as_company_member',
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }
    }

}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name' => 'superadmin',
                'display_name' => 'Super Admin',
                'description' => 'Full system access, can manage all admins and locations',
                'permissions' => [
                    'manage_admins',
                    'manage_roles',
                    'manage_locations',
                    'manage_hostels',
                    'manage_floors',
                    'manage_rooms',
                    'manage_beds',
                    'manage_students',
                    'view_financial',
                    'manage_financial',
                    'view_reports'
                ],
                'is_active' => true
            ],
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'description' => 'Can manage assigned locations and hostels',
                'permissions' => [
                    'manage_hostels',
                    'manage_floors',
                    'manage_rooms',
                    'manage_beds',
                    'manage_students',
                    'view_financial',
                    'manage_financial',
                    'view_reports'
                ],
                'is_active' => true
            ],
            [
                'name' => 'worker',
                'display_name' => 'Worker',
                'description' => 'Read-only access to bed availability',
                'permissions' => [
                    'view_bed_availability'
                ],
                'is_active' => true
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
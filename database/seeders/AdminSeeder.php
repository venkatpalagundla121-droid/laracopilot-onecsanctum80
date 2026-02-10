<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $superAdminRole = Role::where('name', 'superadmin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $workerRole = Role::where('name', 'worker')->first();

        // Super Admin
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@hostel.com',
            'password' => 'superadmin123',
            'phone' => '+91-9876543210',
            'role_id' => $superAdminRole->id,
            'assigned_locations' => null,
            'is_active' => true
        ]);

        // Admin Users
        Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@hostel.com',
            'password' => 'admin123',
            'phone' => '+91-9876543211',
            'role_id' => $adminRole->id,
            'assigned_locations' => [1, 2],
            'is_active' => true
        ]);

        Admin::create([
            'name' => 'Mumbai Admin',
            'email' => 'mumbai.admin@hostel.com',
            'password' => 'admin123',
            'phone' => '+91-9876543212',
            'role_id' => $adminRole->id,
            'assigned_locations' => [1],
            'is_active' => true
        ]);

        // Worker Users
        Admin::create([
            'name' => 'Worker User',
            'email' => 'worker@hostel.com',
            'password' => 'worker123',
            'phone' => '+91-9876543213',
            'role_id' => $workerRole->id,
            'assigned_locations' => [1, 2],
            'is_active' => true
        ]);
    }
}
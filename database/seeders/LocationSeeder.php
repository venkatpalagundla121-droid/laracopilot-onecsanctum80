<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run()
    {
        Location::create([
            'name' => 'Downtown Campus',
            'address' => '123 Main Street',
            'city' => 'Mumbai',
            'state' => 'Maharashtra',
            'pincode' => '400001'
        ]);
        
        Location::create([
            'name' => 'South Campus',
            'address' => '456 South Avenue',
            'city' => 'Mumbai',
            'state' => 'Maharashtra',
            'pincode' => '400002'
        ]);
        
        Location::create([
            'name' => 'North Extension',
            'address' => '789 North Road',
            'city' => 'Pune',
            'state' => 'Maharashtra',
            'pincode' => '411001'
        ]);
        
        Location::create([
            'name' => 'East Zone',
            'address' => '321 East Street',
            'city' => 'Bangalore',
            'state' => 'Karnataka',
            'pincode' => '560001'
        ]);
        
        Location::create([
            'name' => 'West District',
            'address' => '654 West Lane',
            'city' => 'Delhi',
            'state' => 'Delhi',
            'pincode' => '110001'
        ]);
    }
}
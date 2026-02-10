<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            [
                'name' => 'Mumbai Central',
                'address' => 'Andheri East, Mumbai',
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'pincode' => '400069'
            ],
            [
                'name' => 'Pune Campus',
                'address' => 'Hinjewadi Phase 1, Pune',
                'city' => 'Pune',
                'state' => 'Maharashtra',
                'pincode' => '411057'
            ],
            [
                'name' => 'Bangalore Tech Park',
                'address' => 'Whitefield, Bangalore',
                'city' => 'Bangalore',
                'state' => 'Karnataka',
                'pincode' => '560066'
            ],
            [
                'name' => 'Delhi NCR Hub',
                'address' => 'Sector 62, Noida',
                'city' => 'Noida',
                'state' => 'Uttar Pradesh',
                'pincode' => '201301'
            ],
            [
                'name' => 'Hyderabad IT District',
                'address' => 'HITEC City, Hyderabad',
                'city' => 'Hyderabad',
                'state' => 'Telangana',
                'pincode' => '500081'
            ]
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
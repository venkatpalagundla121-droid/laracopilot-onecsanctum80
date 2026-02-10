<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hostel;
use App\Models\Location;

class HostelSeeder extends Seeder
{
    public function run()
    {
        $locations = Location::all();
        
        foreach ($locations as $location) {
            Hostel::create([
                'name' => $location->name . ' Boys Hostel',
                'location_id' => $location->id,
                'address' => $location->address . ' - Building A',
                'contact_number' => '+91-' . rand(7000000000, 9999999999),
                'total_floors' => rand(3, 5)
            ]);
            
            Hostel::create([
                'name' => $location->name . ' Girls Hostel',
                'location_id' => $location->id,
                'address' => $location->address . ' - Building B',
                'contact_number' => '+91-' . rand(7000000000, 9999999999),
                'total_floors' => rand(3, 5)
            ]);
        }
    }
}
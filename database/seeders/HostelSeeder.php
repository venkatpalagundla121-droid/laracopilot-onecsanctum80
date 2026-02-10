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

        $hostels = [
            ['name' => 'Boys Hostel A', 'contact' => '+91-9876543220', 'floors' => 4],
            ['name' => 'Girls Hostel B', 'contact' => '+91-9876543221', 'floors' => 3],
        ];

        foreach ($locations as $location) {
            foreach ($hostels as $hostel) {
                Hostel::create([
                    'name' => $hostel['name'],
                    'location_id' => $location->id,
                    'address' => $location->address,
                    'contact_number' => $hostel['contact'],
                    'email' => strtolower(str_replace(' ', '.', $hostel['name'])) . '@hostel.com',
                    'total_floors' => $hostel['floors'],
                    'is_active' => true
                ]);
            }
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Floor;
use App\Models\Hostel;

class FloorSeeder extends Seeder
{
    public function run()
    {
        $hostels = Hostel::all();

        foreach ($hostels as $hostel) {
            for ($i = 0; $i < $hostel->total_floors; $i++) {
                Floor::create([
                    'hostel_id' => $hostel->id,
                    'floor_number' => $i,
                    'floor_name' => $i === 0 ? 'Ground Floor' : ($i === 1 ? 'First Floor' : ($i === 2 ? 'Second Floor' : ($i === 3 ? 'Third Floor' : 'Floor ' . $i))),
                    'total_rooms' => rand(8, 12)
                ]);
            }
        }
    }
}
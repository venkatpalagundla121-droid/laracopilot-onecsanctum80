<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Floor;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $floors = Floor::all();
        $roomTypes = ['Single', 'Double', 'Triple', 'Quad'];
        $capacities = [1, 2, 3, 4];
        
        foreach ($floors as $floor) {
            for ($i = 1; $i <= $floor->total_rooms; $i++) {
                $typeIndex = array_rand($roomTypes);
                
                Room::create([
                    'floor_id' => $floor->id,
                    'room_number' => str_pad($floor->floor_number, 2, '0', STR_PAD_LEFT) . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'room_type' => $roomTypes[$typeIndex],
                    'bed_capacity' => $capacities[$typeIndex]
                ]);
            }
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bed;
use App\Models\Room;

class BedSeeder extends Seeder
{
    public function run()
    {
        $rooms = Room::all();
        $bedTypes = ['Standard', 'Premium', 'Deluxe'];
        
        foreach ($rooms as $room) {
            for ($i = 1; $i <= $room->bed_capacity; $i++) {
                Bed::create([
                    'room_id' => $room->id,
                    'bed_number' => $room->room_number . '-' . chr(64 + $i),
                    'bed_type' => $bedTypes[array_rand($bedTypes)],
                    'is_occupied' => rand(0, 1) == 1
                ]);
            }
        }
    }
}
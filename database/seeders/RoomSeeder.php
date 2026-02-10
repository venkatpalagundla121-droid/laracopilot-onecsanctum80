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

        foreach ($floors as $floor) {
            for ($i = 1; $i <= $floor->total_rooms; $i++) {
                $roomType = $roomTypes[array_rand($roomTypes)];
                $capacity = match($roomType) {
                    'Single' => 1,
                    'Double' => 2,
                    'Triple' => 3,
                    'Quad' => 4,
                    default => 2
                };

                $room = Room::create([
                    'floor_id' => $floor->id,
                    'room_number' => ($floor->floor_number * 100 + $i),
                    'room_type' => $roomType,
                    'bed_capacity' => $capacity,
                    'rent_per_bed' => rand(5000, 15000),
                    'is_active' => true
                ]);

                // Auto-generate beds for this room
                for ($j = 1; $j <= $capacity; $j++) {
                    \App\Models\Bed::create([
                        'room_id' => $room->id,
                        'bed_number' => $room->room_number . '-' . chr(64 + $j),
                        'bed_type' => ['Standard', 'Premium', 'Deluxe'][array_rand(['Standard', 'Premium', 'Deluxe'])],
                        'is_occupied' => false
                    ]);
                }
            }
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            LocationSeeder::class,
            HostelSeeder::class,
            FloorSeeder::class,
            RoomSeeder::class,
            BedSeeder::class,
            StudentSeeder::class,
            FinancialTransactionSeeder::class
        ]);
    }
}
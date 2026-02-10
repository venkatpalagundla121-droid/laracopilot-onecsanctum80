<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
            LocationSeeder::class,
            HostelSeeder::class,
            FloorSeeder::class,
            RoomSeeder::class,
            StudentSeeder::class,
            FinancialTransactionSeeder::class,
        ]);
    }
}
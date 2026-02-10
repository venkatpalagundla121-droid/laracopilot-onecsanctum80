<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Bed;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $occupiedBeds = Bed::where('is_occupied', true)->get();
        
        $firstNames = ['Rahul', 'Priya', 'Amit', 'Sneha', 'Rohan', 'Anjali', 'Vikram', 'Pooja', 'Arjun', 'Neha', 'Karan', 'Divya', 'Sanjay', 'Riya', 'Aditya'];
        $lastNames = ['Sharma', 'Patel', 'Kumar', 'Singh', 'Reddy', 'Verma', 'Gupta', 'Desai', 'Mehta', 'Joshi'];
        
        foreach ($occupiedBeds as $bed) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $fullName = $firstName . ' ' . $lastName;
            
            Student::create([
                'name' => $fullName,
                'email' => strtolower(str_replace(' ', '.', $fullName)) . rand(1, 999) . '@student.com',
                'phone' => '+91-' . rand(7000000000, 9999999999),
                'guardian_name' => $lastNames[array_rand($lastNames)] . ' ' . $lastNames[array_rand($lastNames)],
                'guardian_phone' => '+91-' . rand(7000000000, 9999999999),
                'bed_id' => $bed->id,
                'admission_date' => now()->subDays(rand(1, 365)),
                'monthly_fee' => rand(5000, 15000)
            ]);
        }
    }
}
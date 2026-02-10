<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Bed;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $availableBeds = Bed::where('is_occupied', false)->limit(50)->get();

        $names = ['Rahul Sharma', 'Priya Patel', 'Amit Kumar', 'Sneha Reddy', 'Vikram Singh', 'Anjali Gupta', 'Rohan Mehta', 'Pooja Desai', 'Arjun Nair', 'Kavya Iyer'];

        foreach ($availableBeds as $index => $bed) {
            $name = $names[array_rand($names)];
            $email = strtolower(str_replace(' ', '.', $name)) . rand(1, 999) . '@student.com';

            Student::create([
                'name' => $name,
                'email' => $email,
                'phone' => '+91-' . rand(7000000000, 9999999999),
                'address' => 'House No. ' . rand(1, 999) . ', Street ' . rand(1, 50),
                'guardian_name' => explode(' ', $name)[0] . ' ' . ['Father', 'Mother'][array_rand(['Father', 'Mother'])],
                'guardian_phone' => '+91-' . rand(7000000000, 9999999999),
                'bed_id' => $bed->id,
                'admission_date' => now()->subDays(rand(1, 365)),
                'monthly_fee' => rand(8000, 15000),
                'payment_status' => ['Paid', 'Pending', 'Overdue'][array_rand(['Paid', 'Pending', 'Overdue'])],
                'is_active' => true
            ]);

            $bed->update(['is_occupied' => true]);
        }
    }
}
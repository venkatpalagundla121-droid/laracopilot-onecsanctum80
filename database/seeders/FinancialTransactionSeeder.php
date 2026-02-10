<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FinancialTransaction;
use App\Models\Hostel;
use App\Models\Student;
use App\Models\Admin;

class FinancialTransactionSeeder extends Seeder
{
    public function run()
    {
        $hostels = Hostel::all();
        $students = Student::all();
        $admin = Admin::where('email', 'admin@hostel.com')->first();

        // Income transactions
        $incomeCategories = ['Room Rent', 'Mess Fees', 'Admission Fee', 'Security Deposit', 'Late Fee'];
        foreach ($students->random(30) as $student) {
            FinancialTransaction::create([
                'type' => 'income',
                'category' => $incomeCategories[array_rand($incomeCategories)],
                'description' => 'Monthly payment from ' . $student->name,
                'amount' => $student->monthly_fee,
                'transaction_date' => now()->subDays(rand(1, 60)),
                'hostel_id' => $student->bed->room->floor->hostel_id,
                'student_id' => $student->id,
                'created_by' => $admin->id,
                'payment_method' => ['Cash', 'UPI', 'Bank Transfer', 'Card'][array_rand(['Cash', 'UPI', 'Bank Transfer', 'Card'])],
                'receipt_number' => 'REC' . rand(10000, 99999)
            ]);
        }

        // Expense transactions
        $expenseCategories = ['Electricity Bill', 'Water Bill', 'Staff Salary', 'Food Supplies', 'Maintenance', 'Repairs'];
        foreach ($hostels->random(10) as $hostel) {
            for ($i = 0; $i < 3; $i++) {
                FinancialTransaction::create([
                    'type' => 'expense',
                    'category' => $expenseCategories[array_rand($expenseCategories)],
                    'description' => $expenseCategories[array_rand($expenseCategories)] . ' for ' . $hostel->name,
                    'amount' => rand(5000, 50000),
                    'transaction_date' => now()->subDays(rand(1, 60)),
                    'hostel_id' => $hostel->id,
                    'student_id' => null,
                    'created_by' => $admin->id,
                    'payment_method' => ['Cash', 'Bank Transfer', 'Cheque'][array_rand(['Cash', 'Bank Transfer', 'Cheque'])],
                    'receipt_number' => null
                ]);
            }
        }
    }
}
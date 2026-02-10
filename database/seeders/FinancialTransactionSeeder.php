<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FinancialTransaction;

class FinancialTransactionSeeder extends Seeder
{
    public function run()
    {
        $incomeCategories = ['Room Rent', 'Mess Fees', 'Admission Fee', 'Security Deposit', 'Late Fee'];
        $expenseCategories = ['Electricity Bill', 'Water Bill', 'Maintenance', 'Staff Salary', 'Food Supplies', 'Repairs'];
        
        for ($i = 0; $i < 30; $i++) {
            FinancialTransaction::create([
                'type' => 'income',
                'description' => $incomeCategories[array_rand($incomeCategories)] . ' - ' . now()->subDays(rand(1, 60))->format('M Y'),
                'amount' => rand(5000, 50000),
                'category' => $incomeCategories[array_rand($incomeCategories)],
                'transaction_date' => now()->subDays(rand(1, 60))
            ]);
        }
        
        for ($i = 0; $i < 25; $i++) {
            FinancialTransaction::create([
                'type' => 'expense',
                'description' => $expenseCategories[array_rand($expenseCategories)] . ' - ' . now()->subDays(rand(1, 60))->format('M Y'),
                'amount' => rand(2000, 30000),
                'category' => $expenseCategories[array_rand($expenseCategories)],
                'transaction_date' => now()->subDays(rand(1, 60))
            ]);
        }
    }
}
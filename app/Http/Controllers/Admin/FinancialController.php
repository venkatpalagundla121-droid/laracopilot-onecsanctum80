<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinancialTransaction;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $currentMonth = now()->format('Y-m');
        
        $monthlyIncome = FinancialTransaction::where('type', 'income')
            ->whereRaw('DATE_FORMAT(transaction_date, "%Y-%m") = ?', [$currentMonth])
            ->sum('amount');
        
        $monthlyExpenses = FinancialTransaction::where('type', 'expense')
            ->whereRaw('DATE_FORMAT(transaction_date, "%Y-%m") = ?', [$currentMonth])
            ->sum('amount');
        
        $monthlyProfit = $monthlyIncome - $monthlyExpenses;
        
        $recentTransactions = FinancialTransaction::orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(15)
            ->get();
        
        $incomeByCategory = FinancialTransaction::where('type', 'income')
            ->whereRaw('DATE_FORMAT(transaction_date, "%Y-%m") = ?', [$currentMonth])
            ->selectRaw('category, SUM(amount) as total')
            ->groupBy('category')
            ->get();
        
        $expenseByCategory = FinancialTransaction::where('type', 'expense')
            ->whereRaw('DATE_FORMAT(transaction_date, "%Y-%m") = ?', [$currentMonth])
            ->selectRaw('category, SUM(amount) as total')
            ->groupBy('category')
            ->get();
        
        return view('admin.financial.index', compact(
            'monthlyIncome',
            'monthlyExpenses',
            'monthlyProfit',
            'recentTransactions',
            'incomeByCategory',
            'expenseByCategory'
        ));
    }
    
    public function storeIncome(Request $request)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'transaction_date' => 'required|date'
        ]);
        
        $validated['type'] = 'income';
        
        FinancialTransaction::create($validated);
        return redirect()->route('admin.financial.index')->with('success', 'Income recorded successfully!');
    }
    
    public function storeExpense(Request $request)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'transaction_date' => 'required|date'
        ]);
        
        $validated['type'] = 'expense';
        
        FinancialTransaction::create($validated);
        return redirect()->route('admin.financial.index')->with('success', 'Expense recorded successfully!');
    }
}
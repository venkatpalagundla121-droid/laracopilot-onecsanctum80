@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Financial Dashboard</h1>
    <p class="text-gray-600 mt-1">Track income, expenses, and profitability</p>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Monthly Income</p>
                <p class="text-3xl font-bold text-green-600 mt-2">₹{{ number_format($monthlyIncome, 2) }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <span class="text-3xl">💰</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Monthly Expenses</p>
                <p class="text-3xl font-bold text-red-600 mt-2">₹{{ number_format($monthlyExpenses, 2) }}</p>
            </div>
            <div class="bg-red-100 p-3 rounded-full">
                <span class="text-3xl">💸</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 border-l-4 {{ $monthlyProfit >= 0 ? 'border-blue-500' : 'border-orange-500' }}">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">{{ $monthlyProfit >= 0 ? 'Monthly Profit' : 'Monthly Loss' }}</p>
                <p class="text-3xl font-bold mt-2 {{ $monthlyProfit >= 0 ? 'text-blue-600' : 'text-orange-600' }}">₹{{ number_format(abs($monthlyProfit), 2) }}</p>
            </div>
            <div class="{{ $monthlyProfit >= 0 ? 'bg-blue-100' : 'bg-orange-100' }} p-3 rounded-full">
                <span class="text-3xl">{{ $monthlyProfit >= 0 ? '📈' : '📉' }}</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Profit Margin</p>
                <p class="text-3xl font-bold text-purple-600 mt-2">
                    {{ $monthlyIncome > 0 ? number_format(($monthlyProfit / $monthlyIncome) * 100, 1) : 0 }}%
                </p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <span class="text-3xl">📊</span>
            </div>
        </div>
    </div>
</div>

<!-- Record Income/Expense Forms -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <!-- Record Income -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">📥 Record Income</h3>
        <form action="{{ route('admin.financial.income.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2 text-sm">Description *</label>
                <input type="text" name="description" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g. Student fees for January" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2 text-sm">Amount (₹) *</label>
                <input type="number" step="0.01" name="amount" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="10000" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2 text-sm">Category *</label>
                <select name="category" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <option value="">Select Category</option>
                    <option value="Room Rent">Room Rent</option>
                    <option value="Mess Fees">Mess Fees</option>
                    <option value="Admission Fee">Admission Fee</option>
                    <option value="Security Deposit">Security Deposit</option>
                    <option value="Late Fee">Late Fee</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2 text-sm">Date *</label>
                <input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-lg transition-colors">
                Add Income
            </button>
        </form>
    </div>

    <!-- Record Expense -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">📤 Record Expense</h3>
        <form action="{{ route('admin.financial.expense.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2 text-sm">Description *</label>
                <input type="text" name="description" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="e.g. Electricity bill for January" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2 text-sm">Amount (₹) *</label>
                <input type="number" step="0.01" name="amount" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="5000" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2 text-sm">Category *</label>
                <select name="category" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500" required>
                    <option value="">Select Category</option>
                    <option value="Electricity Bill">Electricity Bill</option>
                    <option value="Water Bill">Water Bill</option>
                    <option value="Staff Salary">Staff Salary</option>
                    <option value="Food Supplies">Food Supplies</option>
                    <option value="Maintenance">Maintenance</option>
                    <option value="Repairs">Repairs</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2 text-sm">Date *</label>
                <input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500" required>
            </div>
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded-lg transition-colors">
                Add Expense
            </button>
        </form>
    </div>
</div>

<!-- Category Breakdown -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <!-- Income by Category -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Income by Category</h3>
        @forelse($incomeByCategory as $income)
            <div class="mb-3">
                <div class="flex justify-between mb-1">
                    <span class="text-gray-700 font-semibold">{{ $income->category }}</span>
                    <span class="text-green-600 font-bold">₹{{ number_format($income->total, 2) }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full" style="width: {{ $monthlyIncome > 0 ? ($income->total / $monthlyIncome) * 100 : 0 }}%"></div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center py-4">No income recorded this month</p>
        @endforelse
    </div>

    <!-- Expenses by Category -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Expenses by Category</h3>
        @forelse($expenseByCategory as $expense)
            <div class="mb-3">
                <div class="flex justify-between mb-1">
                    <span class="text-gray-700 font-semibold">{{ $expense->category }}</span>
                    <span class="text-red-600 font-bold">₹{{ number_format($expense->total, 2) }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-red-600 h-2 rounded-full" style="width: {{ $monthlyExpenses > 0 ? ($expense->total / $monthlyExpenses) * 100 : 0 }}%"></div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center py-4">No expenses recorded this month</p>
        @endforelse
    </div>
</div>

<!-- Recent Transactions -->
<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Transactions</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($recentTransactions as $transaction)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $transaction->transaction_date->format('d M Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($transaction->type === 'income')
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Income</span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">Expense</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $transaction->category }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $transaction->description }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right font-bold {{ $transaction->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $transaction->type === 'income' ? '+' : '-' }}₹{{ number_format($transaction->amount, 2) }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        <div class="text-5xl mb-4">💰</div>
                        <p class="text-lg">No transactions recorded yet</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

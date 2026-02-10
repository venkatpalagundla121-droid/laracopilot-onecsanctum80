@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-600 mt-1">Welcome back, {{ session('admin_name') }}!</p>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-teal-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Total Locations</p>
                <p class="text-3xl font-bold text-teal-600 mt-2">{{ $totalLocations }}</p>
            </div>
            <div class="bg-teal-100 p-3 rounded-full">
                <span class="text-3xl">📍</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Total Hostels</p>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalHostels }}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <span class="text-3xl">🏢</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Total Rooms</p>
                <p class="text-3xl font-bold text-purple-600 mt-2">{{ $totalRooms }}</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <span class="text-3xl">🚪</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-orange-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Total Beds</p>
                <p class="text-3xl font-bold text-orange-600 mt-2">{{ $totalBeds }}</p>
            </div>
            <div class="bg-orange-100 p-3 rounded-full">
                <span class="text-3xl">🛏️</span>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Available Beds</p>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ $availableBeds }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <span class="text-3xl">✅</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Occupied Beds</p>
                <p class="text-3xl font-bold text-red-600 mt-2">{{ $occupiedBeds }}</p>
            </div>
            <div class="bg-red-100 p-3 rounded-full">
                <span class="text-3xl">🔴</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-indigo-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Occupancy Rate</p>
                <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $occupancyRate }}%</p>
            </div>
            <div class="bg-indigo-100 p-3 rounded-full">
                <span class="text-3xl">📊</span>
            </div>
        </div>
    </div>
</div>

<!-- Financial Overview -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Monthly Income</h3>
        <p class="text-3xl font-bold text-green-600">₹{{ number_format($monthlyIncome, 2) }}</p>
        <p class="text-gray-500 text-sm mt-2">Current month</p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Monthly Expenses</h3>
        <p class="text-3xl font-bold text-red-600">₹{{ number_format($monthlyExpenses, 2) }}</p>
        <p class="text-gray-500 text-sm mt-2">Current month</p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">{{ $monthlyProfit >= 0 ? 'Monthly Profit' : 'Monthly Loss' }}</h3>
        <p class="text-3xl font-bold {{ $monthlyProfit >= 0 ? 'text-blue-600' : 'text-orange-600' }}">₹{{ number_format(abs($monthlyProfit), 2) }}</p>
        <p class="text-gray-500 text-sm mt-2">Current month</p>
    </div>
</div>

<!-- Recent Students -->
<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Admissions</h3>
    @if($recentStudents->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hostel</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bed</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monthly Fee</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admission Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($recentStudents as $student)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $student->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $student->bed->room->floor->hostel->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 bg-teal-100 text-teal-800 rounded-full text-sm font-semibold">{{ $student->bed->bed_number }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">₹{{ number_format($student->monthly_fee, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $student->admission_date->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500 text-center py-8">No recent admissions</p>
    @endif
</div>
@endsection

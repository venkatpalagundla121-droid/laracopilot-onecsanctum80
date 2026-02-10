<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Hostel;
use App\Models\Floor;
use App\Models\Room;
use App\Models\Bed;
use App\Models\Student;
use App\Models\FinancialTransaction;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Calculate KPIs
        $totalLocations = Location::count();
        $totalHostels = Hostel::count();
        $totalRooms = Room::count();
        $totalBeds = Bed::count();
        $totalStudents = Student::count();
        $occupiedBeds = Bed::where('is_occupied', true)->count();
        $availableBeds = Bed::where('is_occupied', false)->count();
        
        // Calculate occupancy rate
        $occupancyRate = $totalBeds > 0 ? round(($occupiedBeds / $totalBeds) * 100, 1) : 0;

        // Get monthly financial data
        $currentMonth = now()->startOfMonth();
        $monthlyIncome = FinancialTransaction::where('type', 'income')
            ->where('transaction_date', '>=', $currentMonth)
            ->sum('amount');
        
        $monthlyExpenses = FinancialTransaction::where('type', 'expense')
            ->where('transaction_date', '>=', $currentMonth)
            ->sum('amount');
        
        $monthlyProfit = $monthlyIncome - $monthlyExpenses;

        // Get recent students
        $recentStudents = Student::with('bed.room.floor.hostel')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalLocations',
            'totalHostels',
            'totalRooms',
            'totalBeds',
            'totalStudents',
            'occupiedBeds',
            'availableBeds',
            'occupancyRate',
            'monthlyIncome',
            'monthlyExpenses',
            'monthlyProfit',
            'recentStudents'
        ));
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\Hostel;
use App\Models\Location;
use Illuminate\Http\Request;

class BedAvailabilityController extends Controller
{
    public function index(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $locations = Location::with('hostels')->get();
        
        $query = Bed::with('room.floor.hostel.location')
            ->where('is_occupied', false);
        
        if ($request->has('location_id') && $request->location_id != '') {
            $query->whereHas('room.floor.hostel', function($q) use ($request) {
                $q->where('location_id', $request->location_id);
            });
        }
        
        if ($request->has('hostel_id') && $request->hostel_id != '') {
            $query->whereHas('room.floor', function($q) use ($request) {
                $q->where('hostel_id', $request->hostel_id);
            });
        }
        
        $availableBeds = $query->orderBy('created_at', 'desc')->paginate(20);
        
        $totalAvailable = Bed::where('is_occupied', false)->count();
        $totalOccupied = Bed::where('is_occupied', true)->count();
        $totalBeds = Bed::count();
        $occupancyRate = $totalBeds > 0 ? round(($totalOccupied / $totalBeds) * 100, 1) : 0;
        
        return view('admin.bed-availability.index', compact(
            'availableBeds',
            'locations',
            'totalAvailable',
            'totalOccupied',
            'totalBeds',
            'occupancyRate'
        ));
    }
}
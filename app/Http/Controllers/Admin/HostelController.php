<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\Location;
use Illuminate\Http\Request;

class HostelController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $hostels = Hostel::with('location')->withCount('floors')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.hostels.index', compact('hostels'));
    }
    
    public function create()
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $locations = Location::all();
        return view('admin.hostels.create', compact('locations'));
    }
    
    public function store(Request $request)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'address' => 'required|string',
            'contact_number' => 'required|string|max:15',
            'total_floors' => 'required|integer|min:1'
        ]);
        
        Hostel::create($validated);
        return redirect()->route('admin.hostels.index')->with('success', 'Hostel created successfully!');
    }
    
    public function edit($id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $hostel = Hostel::findOrFail($id);
        $locations = Location::all();
        return view('admin.hostels.edit', compact('hostel', 'locations'));
    }
    
    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'address' => 'required|string',
            'contact_number' => 'required|string|max:15',
            'total_floors' => 'required|integer|min:1'
        ]);
        
        $hostel = Hostel::findOrFail($id);
        $hostel->update($validated);
        return redirect()->route('admin.hostels.index')->with('success', 'Hostel updated successfully!');
    }
    
    public function destroy($id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        Hostel::findOrFail($id)->delete();
        return redirect()->route('admin.hostels.index')->with('success', 'Hostel deleted successfully!');
    }
}
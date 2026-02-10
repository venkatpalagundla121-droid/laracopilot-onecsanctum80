<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $locations = Location::withCount('hostels')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.locations.index', compact('locations'));
    }
    
    public function create()
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        return view('admin.locations.create');
    }
    
    public function store(Request $request)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10'
        ]);
        
        Location::create($validated);
        return redirect()->route('admin.locations.index')->with('success', 'Location created successfully!');
    }
    
    public function edit($id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $location = Location::findOrFail($id);
        return view('admin.locations.edit', compact('location'));
    }
    
    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10'
        ]);
        
        $location = Location::findOrFail($id);
        $location->update($validated);
        return redirect()->route('admin.locations.index')->with('success', 'Location updated successfully!');
    }
    
    public function destroy($id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        Location::findOrFail($id)->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Location deleted successfully!');
    }
}
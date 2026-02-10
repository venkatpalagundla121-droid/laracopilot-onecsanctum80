<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\Hostel;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $floors = Floor::with('hostel')->withCount('rooms')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.floors.index', compact('floors'));
    }
    
    public function create()
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $hostels = Hostel::all();
        return view('admin.floors.create', compact('hostels'));
    }
    
    public function store(Request $request)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'hostel_id' => 'required|exists:hostels,id',
            'floor_number' => 'required|integer|min:0',
            'floor_name' => 'required|string|max:100',
            'total_rooms' => 'required|integer|min:1'
        ]);
        
        Floor::create($validated);
        return redirect()->route('admin.floors.index')->with('success', 'Floor created successfully!');
    }
    
    public function edit($id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $floor = Floor::findOrFail($id);
        $hostels = Hostel::all();
        return view('admin.floors.edit', compact('floor', 'hostels'));
    }
    
    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'hostel_id' => 'required|exists:hostels,id',
            'floor_number' => 'required|integer|min:0',
            'floor_name' => 'required|string|max:100',
            'total_rooms' => 'required|integer|min:1'
        ]);
        
        $floor = Floor::findOrFail($id);
        $floor->update($validated);
        return redirect()->route('admin.floors.index')->with('success', 'Floor updated successfully!');
    }
    
    public function destroy($id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        Floor::findOrFail($id)->delete();
        return redirect()->route('admin.floors.index')->with('success', 'Floor deleted successfully!');
    }
}
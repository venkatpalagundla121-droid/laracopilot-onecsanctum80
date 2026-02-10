<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Floor;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $rooms = Room::with('floor.hostel')->withCount('beds')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.rooms.index', compact('rooms'));
    }
    
    public function create()
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $floors = Floor::with('hostel')->get();
        return view('admin.rooms.create', compact('floors'));
    }
    
    public function store(Request $request)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'floor_id' => 'required|exists:floors,id',
            'room_number' => 'required|string|max:50',
            'room_type' => 'required|string|max:50',
            'bed_capacity' => 'required|integer|min:1'
        ]);
        
        Room::create($validated);
        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully!');
    }
    
    public function edit($id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $room = Room::findOrFail($id);
        $floors = Floor::with('hostel')->get();
        return view('admin.rooms.edit', compact('room', 'floors'));
    }
    
    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'floor_id' => 'required|exists:floors,id',
            'room_number' => 'required|string|max:50',
            'room_type' => 'required|string|max:50',
            'bed_capacity' => 'required|integer|min:1'
        ]);
        
        $room = Room::findOrFail($id);
        $room->update($validated);
        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully!');
    }
    
    public function destroy($id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        Room::findOrFail($id)->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully!');
    }
}
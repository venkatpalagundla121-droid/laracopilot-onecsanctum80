<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\Room;
use Illuminate\Http\Request;

class BedController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $beds = Bed::with('room.floor.hostel', 'student')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.beds.index', compact('beds'));
    }
    
    public function create()
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $rooms = Room::with('floor.hostel')->get();
        return view('admin.beds.create', compact('rooms'));
    }
    
    public function store(Request $request)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'bed_number' => 'required|string|max:50',
            'bed_type' => 'required|string|max:50'
        ]);
        
        $validated['is_occupied'] = false;
        
        Bed::create($validated);
        return redirect()->route('admin.beds.index')->with('success', 'Bed created successfully!');
    }
    
    public function edit($id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $bed = Bed::findOrFail($id);
        $rooms = Room::with('floor.hostel')->get();
        return view('admin.beds.edit', compact('bed', 'rooms'));
    }
    
    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'bed_number' => 'required|string|max:50',
            'bed_type' => 'required|string|max:50'
        ]);
        
        $bed = Bed::findOrFail($id);
        $bed->update($validated);
        return redirect()->route('admin.beds.index')->with('success', 'Bed updated successfully!');
    }
    
    public function destroy($id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $bed = Bed::findOrFail($id);
        
        if ($bed->is_occupied) {
            return redirect()->route('admin.beds.index')->with('error', 'Cannot delete occupied bed!');
        }
        
        $bed->delete();
        return redirect()->route('admin.beds.index')->with('success', 'Bed deleted successfully!');
    }
}
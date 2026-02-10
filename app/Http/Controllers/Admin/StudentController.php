<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Bed;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $students = Student::with('bed.room.floor.hostel')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.students.index', compact('students'));
    }
    
    public function create()
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $availableBeds = Bed::with('room.floor.hostel')
            ->where('is_occupied', false)
            ->get();
        return view('admin.students.create', compact('availableBeds'));
    }
    
    public function store(Request $request)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:15',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:15',
            'bed_id' => 'required|exists:beds,id',
            'admission_date' => 'required|date',
            'monthly_fee' => 'required|numeric|min:0'
        ]);
        
        $bed = Bed::findOrFail($validated['bed_id']);
        
        if ($bed->is_occupied) {
            return back()->withErrors(['bed_id' => 'This bed is already occupied!'])->withInput();
        }
        
        $student = Student::create($validated);
        
        $bed->update(['is_occupied' => true]);
        
        return redirect()->route('admin.students.index')->with('success', 'Student admitted successfully!');
    }
    
    public function edit($id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $student = Student::findOrFail($id);
        $availableBeds = Bed::with('room.floor.hostel')
            ->where(function($query) use ($student) {
                $query->where('is_occupied', false)
                      ->orWhere('id', $student->bed_id);
            })
            ->get();
        return view('admin.students.edit', compact('student', 'availableBeds'));
    }
    
    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'required|string|max:15',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:15',
            'bed_id' => 'required|exists:beds,id',
            'admission_date' => 'required|date',
            'monthly_fee' => 'required|numeric|min:0'
        ]);
        
        $student = Student::findOrFail($id);
        $oldBedId = $student->bed_id;
        
        if ($oldBedId != $validated['bed_id']) {
            $newBed = Bed::findOrFail($validated['bed_id']);
            
            if ($newBed->is_occupied) {
                return back()->withErrors(['bed_id' => 'This bed is already occupied!'])->withInput();
            }
            
            Bed::where('id', $oldBedId)->update(['is_occupied' => false]);
            Bed::where('id', $validated['bed_id'])->update(['is_occupied' => true]);
        }
        
        $student->update($validated);
        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully!');
    }
    
    public function destroy($id)
    {
        if (!session('admin_logged_in') || session('admin_role') !== 'admin') {
            return redirect()->route('admin.login');
        }
        
        $student = Student::findOrFail($id);
        $bedId = $student->bed_id;
        
        $student->delete();
        
        Bed::where('id', $bedId)->update(['is_occupied' => false]);
        
        return redirect()->route('admin.students.index')->with('success', 'Student record deleted and bed freed!');
    }
}
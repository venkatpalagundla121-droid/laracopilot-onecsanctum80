<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Admin Authentication Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Locations Routes (placeholders - controllers will be created next)
Route::get('/admin/locations', function() {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.locations.index', ['locations' => \App\Models\Location::withCount('hostels')->paginate(10)]);
})->name('admin.locations.index');

Route::get('/admin/locations/create', function() {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.locations.create');
})->name('admin.locations.create');

Route::post('/admin/locations', function(\Illuminate\Http\Request $request) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $request->validate(['name' => 'required', 'address' => 'required', 'city' => 'required', 'state' => 'required', 'pincode' => 'required']);
    \App\Models\Location::create($request->all());
    return redirect()->route('admin.locations.index')->with('success', 'Location created successfully');
})->name('admin.locations.store');

Route::get('/admin/locations/{id}/edit', function($id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.locations.edit', ['location' => \App\Models\Location::findOrFail($id)]);
})->name('admin.locations.edit');

Route::put('/admin/locations/{id}', function(\Illuminate\Http\Request $request, $id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $request->validate(['name' => 'required', 'address' => 'required', 'city' => 'required', 'state' => 'required', 'pincode' => 'required']);
    \App\Models\Location::findOrFail($id)->update($request->all());
    return redirect()->route('admin.locations.index')->with('success', 'Location updated successfully');
})->name('admin.locations.update');

Route::delete('/admin/locations/{id}', function($id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    \App\Models\Location::findOrFail($id)->delete();
    return redirect()->route('admin.locations.index')->with('success', 'Location deleted successfully');
})->name('admin.locations.destroy');

// Hostels Routes
Route::get('/admin/hostels', function() {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.hostels.index', ['hostels' => \App\Models\Hostel::with('location')->withCount('floors')->paginate(10)]);
})->name('admin.hostels.index');

Route::get('/admin/hostels/create', function() {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.hostels.create', ['locations' => \App\Models\Location::all()]);
})->name('admin.hostels.create');

Route::post('/admin/hostels', function(\Illuminate\Http\Request $request) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $request->validate(['name' => 'required', 'location_id' => 'required|exists:locations,id', 'address' => 'required', 'contact_number' => 'required', 'total_floors' => 'required|integer']);
    \App\Models\Hostel::create($request->all());
    return redirect()->route('admin.hostels.index')->with('success', 'Hostel created successfully');
})->name('admin.hostels.store');

Route::get('/admin/hostels/{id}/edit', function($id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.hostels.edit', ['hostel' => \App\Models\Hostel::findOrFail($id), 'locations' => \App\Models\Location::all()]);
})->name('admin.hostels.edit');

Route::put('/admin/hostels/{id}', function(\Illuminate\Http\Request $request, $id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $request->validate(['name' => 'required', 'location_id' => 'required|exists:locations,id', 'address' => 'required', 'contact_number' => 'required', 'total_floors' => 'required|integer']);
    \App\Models\Hostel::findOrFail($id)->update($request->all());
    return redirect()->route('admin.hostels.index')->with('success', 'Hostel updated successfully');
})->name('admin.hostels.update');

Route::delete('/admin/hostels/{id}', function($id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    \App\Models\Hostel::findOrFail($id)->delete();
    return redirect()->route('admin.hostels.index')->with('success', 'Hostel deleted successfully');
})->name('admin.hostels.destroy');

// Floors Routes
Route::get('/admin/floors', function() {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.floors.index', ['floors' => \App\Models\Floor::with('hostel')->withCount('rooms')->paginate(10)]);
})->name('admin.floors.index');

Route::get('/admin/floors/create', function() {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.floors.create', ['hostels' => \App\Models\Hostel::with('location')->get()]);
})->name('admin.floors.create');

Route::post('/admin/floors', function(\Illuminate\Http\Request $request) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $request->validate(['hostel_id' => 'required|exists:hostels,id', 'floor_number' => 'required|integer', 'floor_name' => 'required', 'total_rooms' => 'required|integer']);
    \App\Models\Floor::create($request->all());
    return redirect()->route('admin.floors.index')->with('success', 'Floor created successfully');
})->name('admin.floors.store');

Route::get('/admin/floors/{id}/edit', function($id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.floors.edit', ['floor' => \App\Models\Floor::findOrFail($id), 'hostels' => \App\Models\Hostel::with('location')->get()]);
})->name('admin.floors.edit');

Route::put('/admin/floors/{id}', function(\Illuminate\Http\Request $request, $id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $request->validate(['hostel_id' => 'required|exists:hostels,id', 'floor_number' => 'required|integer', 'floor_name' => 'required', 'total_rooms' => 'required|integer']);
    \App\Models\Floor::findOrFail($id)->update($request->all());
    return redirect()->route('admin.floors.index')->with('success', 'Floor updated successfully');
})->name('admin.floors.update');

Route::delete('/admin/floors/{id}', function($id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    \App\Models\Floor::findOrFail($id)->delete();
    return redirect()->route('admin.floors.index')->with('success', 'Floor deleted successfully');
})->name('admin.floors.destroy');

// Rooms Routes
Route::get('/admin/rooms', function() {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.rooms.index', ['rooms' => \App\Models\Room::with('floor.hostel')->withCount('beds')->paginate(10)]);
})->name('admin.rooms.index');

Route::get('/admin/rooms/create', function() {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.rooms.create', ['floors' => \App\Models\Floor::with('hostel')->get()]);
})->name('admin.rooms.create');

Route::post('/admin/rooms', function(\Illuminate\Http\Request $request) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $request->validate(['floor_id' => 'required|exists:floors,id', 'room_number' => 'required', 'room_type' => 'required', 'bed_capacity' => 'required|integer']);
    $room = \App\Models\Room::create($request->all());
    // Auto-generate beds
    for ($i = 1; $i <= $request->bed_capacity; $i++) {
        \App\Models\Bed::create(['room_id' => $room->id, 'bed_number' => $request->room_number . '-' . chr(64 + $i), 'bed_type' => 'Standard', 'is_occupied' => false]);
    }
    return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully with ' . $request->bed_capacity . ' beds');
})->name('admin.rooms.store');

Route::get('/admin/rooms/{id}/edit', function($id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.rooms.edit', ['room' => \App\Models\Room::findOrFail($id), 'floors' => \App\Models\Floor::with('hostel')->get()]);
})->name('admin.rooms.edit');

Route::put('/admin/rooms/{id}', function(\Illuminate\Http\Request $request, $id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $request->validate(['floor_id' => 'required|exists:floors,id', 'room_number' => 'required', 'room_type' => 'required', 'bed_capacity' => 'required|integer']);
    \App\Models\Room::findOrFail($id)->update($request->all());
    return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully');
})->name('admin.rooms.update');

Route::delete('/admin/rooms/{id}', function($id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    \App\Models\Room::findOrFail($id)->delete();
    return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully');
})->name('admin.rooms.destroy');

// Beds Routes
Route::get('/admin/beds', function() {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.beds.index', ['beds' => \App\Models\Bed::with('room.floor.hostel', 'student')->paginate(15)]);
})->name('admin.beds.index');

Route::get('/admin/beds/create', function() {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.beds.create', ['rooms' => \App\Models\Room::with('floor.hostel')->get()]);
})->name('admin.beds.create');

Route::post('/admin/beds', function(\Illuminate\Http\Request $request) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $request->validate(['room_id' => 'required|exists:rooms,id', 'bed_number' => 'required', 'bed_type' => 'required']);
    \App\Models\Bed::create(array_merge($request->all(), ['is_occupied' => false]));
    return redirect()->route('admin.beds.index')->with('success', 'Bed created successfully');
})->name('admin.beds.store');

Route::get('/admin/beds/{id}/edit', function($id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.beds.edit', ['bed' => \App\Models\Bed::with('student')->findOrFail($id), 'rooms' => \App\Models\Room::with('floor.hostel')->get()]);
})->name('admin.beds.edit');

Route::put('/admin/beds/{id}', function(\Illuminate\Http\Request $request, $id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $request->validate(['room_id' => 'required|exists:rooms,id', 'bed_number' => 'required', 'bed_type' => 'required']);
    \App\Models\Bed::findOrFail($id)->update($request->except('is_occupied'));
    return redirect()->route('admin.beds.index')->with('success', 'Bed updated successfully');
})->name('admin.beds.update');

Route::delete('/admin/beds/{id}', function($id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $bed = \App\Models\Bed::findOrFail($id);
    if ($bed->is_occupied) {
        return redirect()->route('admin.beds.index')->with('error', 'Cannot delete occupied bed');
    }
    $bed->delete();
    return redirect()->route('admin.beds.index')->with('success', 'Bed deleted successfully');
})->name('admin.beds.destroy');

// Students Routes
Route::get('/admin/students', function() {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.students.index', ['students' => \App\Models\Student::with('bed.room.floor.hostel')->paginate(15)]);
})->name('admin.students.index');

Route::get('/admin/students/create', function() {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    return view('admin.students.create', ['availableBeds' => \App\Models\Bed::with('room.floor.hostel')->where('is_occupied', false)->get()]);
})->name('admin.students.create');

Route::post('/admin/students', function(\Illuminate\Http\Request $request) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $request->validate(['name' => 'required', 'email' => 'required|email|unique:students', 'phone' => 'required', 'guardian_name' => 'required', 'guardian_phone' => 'required', 'bed_id' => 'required|exists:beds,id', 'admission_date' => 'required|date', 'monthly_fee' => 'required|numeric']);
    \App\Models\Student::create($request->all());
    \App\Models\Bed::findOrFail($request->bed_id)->update(['is_occupied' => true]);
    return redirect()->route('admin.students.index')->with('success', 'Student admitted successfully');
})->name('admin.students.store');

Route::get('/admin/students/{id}/edit', function($id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $student = \App\Models\Student::findOrFail($id);
    $availableBeds = \App\Models\Bed::with('room.floor.hostel')->where(function($q) use ($student) {
        $q->where('is_occupied', false)->orWhere('id', $student->bed_id);
    })->get();
    return view('admin.students.edit', compact('student', 'availableBeds'));
})->name('admin.students.edit');

Route::put('/admin/students/{id}', function(\Illuminate\Http\Request $request, $id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $request->validate(['name' => 'required', 'email' => 'required|email', 'phone' => 'required', 'guardian_name' => 'required', 'guardian_phone' => 'required', 'bed_id' => 'required|exists:beds,id', 'admission_date' => 'required|date', 'monthly_fee' => 'required|numeric']);
    $student = \App\Models\Student::findOrFail($id);
    $oldBedId = $student->bed_id;
    $student->update($request->all());
    if ($oldBedId != $request->bed_id) {
        \App\Models\Bed::findOrFail($oldBedId)->update(['is_occupied' => false]);
        \App\Models\Bed::findOrFail($request->bed_id)->update(['is_occupied' => true]);
    }
    return redirect()->route('admin.students.index')->with('success', 'Student updated successfully');
})->name('admin.students.update');

Route::delete('/admin/students/{id}', function($id) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $student = \App\Models\Student::findOrFail($id);
    \App\Models\Bed::findOrFail($student->bed_id)->update(['is_occupied' => false]);
    $student->delete();
    return redirect()->route('admin.students.index')->with('success', 'Student deleted and bed is now available');
})->name('admin.students.destroy');

// Financial Routes
Route::get('/admin/financial', function() {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $currentMonth = now()->startOfMonth();
    $monthlyIncome = \App\Models\FinancialTransaction::where('type', 'income')->where('transaction_date', '>=', $currentMonth)->sum('amount');
    $monthlyExpenses = \App\Models\FinancialTransaction::where('type', 'expense')->where('transaction_date', '>=', $currentMonth)->sum('amount');
    $monthlyProfit = $monthlyIncome - $monthlyExpenses;
    $incomeByCategory = \App\Models\FinancialTransaction::selectRaw('category, sum(amount) as total')->where('type', 'income')->where('transaction_date', '>=', $currentMonth)->groupBy('category')->get();
    $expenseByCategory = \App\Models\FinancialTransaction::selectRaw('category, sum(amount) as total')->where('type', 'expense')->where('transaction_date', '>=', $currentMonth)->groupBy('category')->get();
    $recentTransactions = \App\Models\FinancialTransaction::orderBy('transaction_date', 'desc')->limit(10)->get();
    return view('admin.financial.index', compact('monthlyIncome', 'monthlyExpenses', 'monthlyProfit', 'incomeByCategory', 'expenseByCategory', 'recentTransactions'));
})->name('admin.financial.index');

Route::post('/admin/financial/income', function(\Illuminate\Http\Request $request) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $request->validate(['description' => 'required', 'amount' => 'required|numeric', 'category' => 'required', 'transaction_date' => 'required|date']);
    \App\Models\FinancialTransaction::create(array_merge($request->all(), ['type' => 'income']));
    return redirect()->route('admin.financial.index')->with('success', 'Income recorded successfully');
})->name('admin.financial.income.store');

Route::post('/admin/financial/expense', function(\Illuminate\Http\Request $request) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $request->validate(['description' => 'required', 'amount' => 'required|numeric', 'category' => 'required', 'transaction_date' => 'required|date']);
    \App\Models\FinancialTransaction::create(array_merge($request->all(), ['type' => 'expense']));
    return redirect()->route('admin.financial.index')->with('success', 'Expense recorded successfully');
})->name('admin.financial.expense.store');

// Bed Availability Routes
Route::get('/admin/bed-availability', function(\Illuminate\Http\Request $request) {
    if (!session('admin_logged_in')) return redirect()->route('admin.login');
    $query = \App\Models\Bed::with('room.floor.hostel.location')->where('is_occupied', false);
    if ($request->location_id) {
        $query->whereHas('room.floor.hostel.location', fn($q) => $q->where('id', $request->location_id));
    }
    if ($request->hostel_id) {
        $query->whereHas('room.floor.hostel', fn($q) => $q->where('id', $request->hostel_id));
    }
    $availableBeds = $query->paginate(15);
    $totalAvailable = \App\Models\Bed::where('is_occupied', false)->count();
    $totalOccupied = \App\Models\Bed::where('is_occupied', true)->count();
    $totalBeds = \App\Models\Bed::count();
    $occupancyRate = $totalBeds > 0 ? round(($totalOccupied / $totalBeds) * 100, 1) : 0;
    $locations = \App\Models\Location::with('hostels')->get();
    return view('admin.bed-availability.index', compact('availableBeds', 'totalAvailable', 'totalOccupied', 'totalBeds', 'occupancyRate', 'locations'));
})->name('admin.bed-availability.index');

// Worker Dashboard Route
Route::get('/worker/dashboard', function(\Illuminate\Http\Request $request) {
    if (!session('admin_logged_in') || session('admin_role') !== 'worker') {
        return redirect()->route('admin.login');
    }
    $query = \App\Models\Bed::with('room.floor.hostel.location')->where('is_occupied', false);
    if ($request->location_id) {
        $query->whereHas('room.floor.hostel.location', fn($q) => $q->where('id', $request->location_id));
    }
    if ($request->hostel_id) {
        $query->whereHas('room.floor.hostel', fn($q) => $q->where('id', $request->hostel_id));
    }
    $availableBeds = $query->paginate(15);
    $totalAvailable = \App\Models\Bed::where('is_occupied', false)->count();
    $totalOccupied = \App\Models\Bed::where('is_occupied', true)->count();
    $totalBeds = \App\Models\Bed::count();
    $occupancyRate = $totalBeds > 0 ? round(($totalOccupied / $totalBeds) * 100, 1) : 0;
    $locations = \App\Models\Location::with('hostels')->get();
    return view('worker.dashboard', compact('availableBeds', 'totalAvailable', 'totalOccupied', 'totalBeds', 'occupancyRate', 'locations'));
})->name('worker.dashboard');
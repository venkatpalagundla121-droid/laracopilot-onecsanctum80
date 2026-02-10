<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Protected Admin Routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Location routes will use controllers
    Route::get('/locations', function() {
        return view('admin.locations.index', ['locations' => \App\Models\Location::withCount('hostels')->paginate(10)]);
    })->name('locations.index');
    
    Route::get('/locations/create', function() {
        return view('admin.locations.create');
    })->name('locations.create');
    
    Route::post('/locations', function(\Illuminate\Http\Request $request) {
        $request->validate(['name' => 'required', 'address' => 'required', 'city' => 'required', 'state' => 'required', 'pincode' => 'required']);
        \App\Models\Location::create($request->all());
        return redirect()->route('admin.locations.index')->with('success', 'Location created');
    })->name('locations.store');
    
    Route::get('/locations/{id}/edit', function($id) {
        return view('admin.locations.edit', ['location' => \App\Models\Location::findOrFail($id)]);
    })->name('locations.edit');
    
    Route::put('/locations/{id}', function(\Illuminate\Http\Request $request, $id) {
        $request->validate(['name' => 'required', 'address' => 'required', 'city' => 'required', 'state' => 'required', 'pincode' => 'required']);
        \App\Models\Location::findOrFail($id)->update($request->all());
        return redirect()->route('admin.locations.index')->with('success', 'Location updated');
    })->name('locations.update');
    
    Route::delete('/locations/{id}', function($id) {
        \App\Models\Location::findOrFail($id)->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Location deleted');
    })->name('locations.destroy');
});

// Worker Routes
Route::middleware(['auth:admin'])->prefix('worker')->name('worker.')->group(function () {
    Route::get('/dashboard', function() {
        $admin = auth()->guard('admin')->user();
        if (!$admin->isWorker()) {
            return redirect()->route('admin.dashboard');
        }
        $query = \App\Models\Bed::with('room.floor.hostel.location')->where('is_occupied', false);
        $availableBeds = $query->paginate(15);
        $totalAvailable = \App\Models\Bed::where('is_occupied', false)->count();
        $totalOccupied = \App\Models\Bed::where('is_occupied', true)->count();
        $totalBeds = \App\Models\Bed::count();
        $occupancyRate = $totalBeds > 0 ? round(($totalOccupied / $totalBeds) * 100, 1) : 0;
        $locations = \App\Models\Location::with('hostels')->get();
        return view('worker.dashboard', compact('availableBeds', 'totalAvailable', 'totalOccupied', 'totalBeds', 'occupancyRate', 'locations'));
    })->name('dashboard');
});
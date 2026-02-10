@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Bed Availability Dashboard</h1>
    <p class="text-gray-600 mt-1">View all available beds across locations and hostels</p>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Available Beds</p>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalAvailable }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <span class="text-3xl">✅</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Occupied Beds</p>
                <p class="text-3xl font-bold text-red-600 mt-2">{{ $totalOccupied }}</p>
            </div>
            <div class="bg-red-100 p-3 rounded-full">
                <span class="text-3xl">🔴</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Total Beds</p>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalBeds }}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <span class="text-3xl">🛏️</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Occupancy Rate</p>
                <p class="text-3xl font-bold text-purple-600 mt-2">{{ $occupancyRate }}%</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <span class="text-3xl">📊</span>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h3 class="text-lg font-bold text-gray-800 mb-4">Filter Available Beds</h3>
    <form method="GET" action="{{ route('admin.bed-availability.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-gray-700 font-bold mb-2 text-sm">Location</label>
            <select name="location_id" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option value="">All Locations</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ request('location_id') == $location->id ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-gray-700 font-bold mb-2 text-sm">Hostel</label>
            <select name="hostel_id" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option value="">All Hostels</option>
                @foreach($locations as $location)
                    @foreach($location->hostels as $hostel)
                        <option value="{{ $hostel->id }}" {{ request('hostel_id') == $hostel->id ? 'selected' : '' }}>
                            {{ $hostel->name }}
                        </option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                Apply Filter
            </button>
        </div>
    </form>
</div>

<!-- Available Beds Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bed Number</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hostel</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Floor</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bed Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($availableBeds as $bed)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $bed->bed_number }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $bed->room->floor->hostel->location->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $bed->room->floor->hostel->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $bed->room->floor->floor_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $bed->room->room_number }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm font-semibold">{{ $bed->room->room_type }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">{{ $bed->bed_type }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Available</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                    <div class="text-5xl mb-4">🛏️</div>
                    <p class="text-lg">No available beds found</p>
                    <p class="text-sm text-gray-400 mt-2">All beds are currently occupied or no beds exist in the system</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $availableBeds->links() }}
</div>
@endsection

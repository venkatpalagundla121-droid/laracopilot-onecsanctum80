@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Add New Floor</h1>
    <p class="text-gray-600 mt-1">Create a new floor in a hostel</p>
</div>

<div class="bg-white rounded-lg shadow p-8 max-w-2xl">
    <form action="{{ route('admin.floors.store') }}" method="POST">
        @csrf
        
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Hostel *</label>
            <select name="hostel_id" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('hostel_id') border-red-500 @enderror" required>
                <option value="">Select Hostel</option>
                @foreach($hostels as $hostel)
                    <option value="{{ $hostel->id }}" {{ old('hostel_id') == $hostel->id ? 'selected' : '' }}>
                        {{ $hostel->name }} - {{ $hostel->location->name }}
                    </option>
                @endforeach
            </select>
            @error('hostel_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Floor Number *</label>
            <input type="number" name="floor_number" value="{{ old('floor_number') }}" min="0" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('floor_number') border-red-500 @enderror" placeholder="e.g. 0 for Ground Floor, 1 for First Floor" required>
            @error('floor_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Floor Name *</label>
            <input type="text" name="floor_name" value="{{ old('floor_name') }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('floor_name') border-red-500 @enderror" placeholder="e.g. Ground Floor, First Floor" required>
            @error('floor_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Total Rooms *</label>
            <input type="number" name="total_rooms" value="{{ old('total_rooms') }}" min="1" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('total_rooms') border-red-500 @enderror" placeholder="e.g. 10" required>
            @error('total_rooms')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.floors.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition-colors">
                Cancel
            </a>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                Create Floor
            </button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Add New Room</h1>
    <p class="text-gray-600 mt-1">Create a new room on a floor</p>
</div>

<div class="bg-white rounded-lg shadow p-8 max-w-2xl">
    <form action="{{ route('admin.rooms.store') }}" method="POST">
        @csrf
        
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Floor *</label>
            <select name="floor_id" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('floor_id') border-red-500 @enderror" required>
                <option value="">Select Floor</option>
                @foreach($floors as $floor)
                    <option value="{{ $floor->id }}" {{ old('floor_id') == $floor->id ? 'selected' : '' }}>
                        {{ $floor->hostel->name }} - {{ $floor->floor_name }}
                    </option>
                @endforeach
            </select>
            @error('floor_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Room Number *</label>
            <input type="text" name="room_number" value="{{ old('room_number') }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('room_number') border-red-500 @enderror" placeholder="e.g. 101, 102" required>
            @error('room_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Room Type *</label>
            <select name="room_type" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('room_type') border-red-500 @enderror" required>
                <option value="">Select Room Type</option>
                <option value="Single" {{ old('room_type') == 'Single' ? 'selected' : '' }}>Single</option>
                <option value="Double" {{ old('room_type') == 'Double' ? 'selected' : '' }}>Double</option>
                <option value="Triple" {{ old('room_type') == 'Triple' ? 'selected' : '' }}>Triple</option>
                <option value="Quad" {{ old('room_type') == 'Quad' ? 'selected' : '' }}>Quad</option>
                <option value="Dormitory" {{ old('room_type') == 'Dormitory' ? 'selected' : '' }}>Dormitory</option>
            </select>
            @error('room_type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Bed Capacity *</label>
            <input type="number" name="bed_capacity" value="{{ old('bed_capacity') }}" min="1" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('bed_capacity') border-red-500 @enderror" placeholder="e.g. 2" required>
            <p class="text-gray-500 text-sm mt-1">Beds will be auto-generated based on this capacity</p>
            @error('bed_capacity')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.rooms.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition-colors">
                Cancel
            </a>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                Create Room
            </button>
        </div>
    </form>
</div>
@endsection

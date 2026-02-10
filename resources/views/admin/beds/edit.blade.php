@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Edit Bed</h1>
    <p class="text-gray-600 mt-1">Update bed information</p>
</div>

<div class="bg-white rounded-lg shadow p-8 max-w-2xl">
    <form action="{{ route('admin.beds.update', $bed->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Room *</label>
            <select name="room_id" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('room_id') border-red-500 @enderror" required>
                <option value="">Select Room</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ old('room_id', $bed->room_id) == $room->id ? 'selected' : '' }}>
                        {{ $room->room_number }} - {{ $room->floor->hostel->name }} - {{ $room->floor->floor_name }}
                    </option>
                @endforeach
            </select>
            @error('room_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Bed Number *</label>
            <input type="text" name="bed_number" value="{{ old('bed_number', $bed->bed_number) }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('bed_number') border-red-500 @enderror" required>
            @error('bed_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Bed Type *</label>
            <select name="bed_type" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('bed_type') border-red-500 @enderror" required>
                <option value="">Select Bed Type</option>
                <option value="Standard" {{ old('bed_type', $bed->bed_type) == 'Standard' ? 'selected' : '' }}>Standard</option>
                <option value="Premium" {{ old('bed_type', $bed->bed_type) == 'Premium' ? 'selected' : '' }}>Premium</option>
                <option value="Deluxe" {{ old('bed_type', $bed->bed_type) == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
            </select>
            @error('bed_type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        @if($bed->is_occupied)
            <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <p class="text-yellow-800 font-semibold">⚠️ This bed is currently occupied by {{ $bed->student->name }}</p>
            </div>
        @endif

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.beds.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition-colors">
                Cancel
            </a>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                Update Bed
            </button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Add New Hostel</h1>
    <p class="text-gray-600 mt-1">Create a new hostel under a location</p>
</div>

<div class="bg-white rounded-lg shadow p-8 max-w-2xl">
    <form action="{{ route('admin.hostels.store') }}" method="POST">
        @csrf
        
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Hostel Name *</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('name') border-red-500 @enderror" placeholder="e.g. Downtown Boys Hostel" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Location *</label>
            <select name="location_id" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('location_id') border-red-500 @enderror" required>
                <option value="">Select Location</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                        {{ $location->name }} - {{ $location->city }}
                    </option>
                @endforeach
            </select>
            @error('location_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Full Address *</label>
            <textarea name="address" rows="3" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('address') border-red-500 @enderror" placeholder="Complete address of hostel" required>{{ old('address') }}</textarea>
            @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Contact Number *</label>
            <input type="text" name="contact_number" value="{{ old('contact_number') }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('contact_number') border-red-500 @enderror" placeholder="e.g. +91-9876543210" required>
            @error('contact_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Total Floors *</label>
            <input type="number" name="total_floors" value="{{ old('total_floors') }}" min="1" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('total_floors') border-red-500 @enderror" placeholder="e.g. 4" required>
            @error('total_floors')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.hostels.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition-colors">
                Cancel
            </a>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                Create Hostel
            </button>
        </div>
    </form>
</div>
@endsection

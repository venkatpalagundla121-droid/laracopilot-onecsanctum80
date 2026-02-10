@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Add New Location</h1>
    <p class="text-gray-600 mt-1">Create a new location for hostel management</p>
</div>

<div class="bg-white rounded-lg shadow p-8 max-w-2xl">
    <form action="{{ route('admin.locations.store') }}" method="POST">
        @csrf
        
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Location Name *</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('name') border-red-500 @enderror" placeholder="e.g. Downtown Campus" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Full Address *</label>
            <textarea name="address" rows="3" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('address') border-red-500 @enderror" placeholder="Complete street address" required>{{ old('address') }}</textarea>
            @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 font-bold mb-2">City *</label>
                <input type="text" name="city" value="{{ old('city') }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('city') border-red-500 @enderror" placeholder="e.g. Mumbai" required>
                @error('city')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">State *</label>
                <input type="text" name="state" value="{{ old('state') }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('state') border-red-500 @enderror" placeholder="e.g. Maharashtra" required>
                @error('state')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Pincode *</label>
            <input type="text" name="pincode" value="{{ old('pincode') }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('pincode') border-red-500 @enderror" placeholder="e.g. 400001" required>
            @error('pincode')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.locations.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition-colors">
                Cancel
            </a>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                Create Location
            </button>
        </div>
    </form>
</div>
@endsection

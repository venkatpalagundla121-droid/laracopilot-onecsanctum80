@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Edit Location</h1>
    <p class="text-gray-600 mt-1">Update location information</p>
</div>

<div class="bg-white rounded-lg shadow p-8 max-w-2xl">
    <form action="{{ route('admin.locations.update', $location->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Location Name *</label>
            <input type="text" name="name" value="{{ old('name', $location->name) }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('name') border-red-500 @enderror" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Full Address *</label>
            <textarea name="address" rows="3" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('address') border-red-500 @enderror" required>{{ old('address', $location->address) }}</textarea>
            @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 font-bold mb-2">City *</label>
                <input type="text" name="city" value="{{ old('city', $location->city) }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('city') border-red-500 @enderror" required>
                @error('city')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">State *</label>
                <input type="text" name="state" value="{{ old('state', $location->state) }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('state') border-red-500 @enderror" required>
                @error('state')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Pincode *</label>
            <input type="text" name="pincode" value="{{ old('pincode', $location->pincode) }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('pincode') border-red-500 @enderror" required>
            @error('pincode')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.locations.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition-colors">
                Cancel
            </a>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                Update Location
            </button>
        </div>
    </form>
</div>
@endsection

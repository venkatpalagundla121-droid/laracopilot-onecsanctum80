@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Admit New Student</h1>
    <p class="text-gray-600 mt-1">Register a new student and assign a bed</p>
</div>

<div class="bg-white rounded-lg shadow p-8 max-w-3xl">
    <form action="{{ route('admin.students.store') }}" method="POST">
        @csrf
        
        <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Student Information</h3>
        
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Full Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('name') border-red-500 @enderror" placeholder="Enter full name" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Email Address *</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('email') border-red-500 @enderror" placeholder="student@example.com" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Phone Number *</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('phone') border-red-500 @enderror" placeholder="+91-9876543210" required>
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2 mt-8">Guardian Information</h3>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Guardian Name *</label>
                <input type="text" name="guardian_name" value="{{ old('guardian_name') }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('guardian_name') border-red-500 @enderror" placeholder="Parent/Guardian name" required>
                @error('guardian_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Guardian Phone *</label>
                <input type="text" name="guardian_phone" value="{{ old('guardian_phone') }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('guardian_phone') border-red-500 @enderror" placeholder="+91-9876543210" required>
                @error('guardian_phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2 mt-8">Admission Details</h3>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Assign Bed *</label>
            <select name="bed_id" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('bed_id') border-red-500 @enderror" required>
                <option value="">Select Available Bed</option>
                @forelse($availableBeds as $bed)
                    <option value="{{ $bed->id }}" {{ old('bed_id') == $bed->id ? 'selected' : '' }}>
                        {{ $bed->room->floor->hostel->name }} - {{ $bed->room->floor->floor_name }} - Room {{ $bed->room->room_number }} - Bed {{ $bed->bed_number }}
                    </option>
                @empty
                    <option value="" disabled>No beds available</option>
                @endforelse
            </select>
            @error('bed_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Admission Date *</label>
                <input type="date" name="admission_date" value="{{ old('admission_date', date('Y-m-d')) }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('admission_date') border-red-500 @enderror" required>
                @error('admission_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Monthly Fee (₹) *</label>
                <input type="number" step="0.01" name="monthly_fee" value="{{ old('monthly_fee') }}" class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('monthly_fee') border-red-500 @enderror" placeholder="10000" required>
                @error('monthly_fee')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-8">
            <a href="{{ route('admin.students.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition-colors">
                Cancel
            </a>
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                Admit Student
            </button>
        </div>
    </form>
</div>
@endsection

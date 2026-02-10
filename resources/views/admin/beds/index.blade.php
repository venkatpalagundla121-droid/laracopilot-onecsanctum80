@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Beds</h1>
        <p class="text-gray-600 mt-1">Manage all beds and their occupancy status</p>
    </div>
    <a href="{{ route('admin.beds.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
        + Add Bed
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bed Number</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hostel</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Floor</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bed Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Occupied By</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($beds as $bed)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $bed->bed_number }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $bed->room->floor->hostel->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $bed->room->floor->floor_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $bed->room->room_number }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">{{ $bed->bed_type }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($bed->is_occupied)
                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">Occupied</span>
                    @else
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Available</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                    @if($bed->student)
                        <a href="{{ route('admin.students.edit', $bed->student->id) }}" class="text-teal-600 hover:underline">
                            {{ $bed->student->name }}
                        </a>
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                    <a href="{{ route('admin.beds.edit', $bed->id) }}" class="text-blue-600 hover:text-blue-800 font-medium mr-3">Edit</a>
                    <form action="{{ route('admin.beds.destroy', $bed->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Delete this bed? {{ $bed->is_occupied ? 'This bed is currently occupied!' : '' }}')" {{ $bed->is_occupied ? 'disabled' : '' }}>
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                    <div class="text-5xl mb-4">🛏️</div>
                    <p class="text-lg">No beds found. Add your first bed to get started.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $beds->links() }}
</div>
@endsection

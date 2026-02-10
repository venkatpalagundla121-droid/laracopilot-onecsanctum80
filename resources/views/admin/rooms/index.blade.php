@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Rooms</h1>
        <p class="text-gray-600 mt-1">Manage rooms across all floors</p>
    </div>
    <a href="{{ route('admin.rooms.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
        + Add Room
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room Number</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hostel</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Floor</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bed Capacity</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Beds</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($rooms as $room)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $room->room_number }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $room->floor->hostel->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $room->floor->floor_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm font-semibold">{{ $room->room_type }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $room->bed_capacity }} beds</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-semibold">{{ $room->beds_count }} created</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                    <a href="{{ route('admin.rooms.edit', $room->id) }}" class="text-blue-600 hover:text-blue-800 font-medium mr-3">Edit</a>
                    <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Delete this room? All beds will also be deleted.')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                    <div class="text-5xl mb-4">🚪</div>
                    <p class="text-lg">No rooms found. Add your first room to get started.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $rooms->links() }}
</div>
@endsection

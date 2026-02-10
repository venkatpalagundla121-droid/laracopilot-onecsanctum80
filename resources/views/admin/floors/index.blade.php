@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Floors</h1>
        <p class="text-gray-600 mt-1">Manage floors across all hostels</p>
    </div>
    <a href="{{ route('admin.floors.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
        + Add Floor
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Floor Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hostel</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Floor Number</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Rooms</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rooms</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($floors as $floor)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $floor->floor_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $floor->hostel->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-semibold">{{ $floor->floor_number }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $floor->total_rooms }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold">{{ $floor->rooms_count }} created</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                    <a href="{{ route('admin.floors.edit', $floor->id) }}" class="text-blue-600 hover:text-blue-800 font-medium mr-3">Edit</a>
                    <form action="{{ route('admin.floors.destroy', $floor->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Delete this floor? All rooms and beds will also be deleted.')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                    <div class="text-5xl mb-4">🏗️</div>
                    <p class="text-lg">No floors found. Add your first floor to get started.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $floors->links() }}
</div>
@endsection

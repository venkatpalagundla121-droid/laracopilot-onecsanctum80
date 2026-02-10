@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Locations</h1>
        <p class="text-gray-600 mt-1">Manage all hostel locations</p>
    </div>
    <a href="{{ route('admin.locations.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
        + Add Location
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">State</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pincode</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hostels</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($locations as $location)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $location->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $location->city }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $location->state }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $location->pincode }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-teal-100 text-teal-800 rounded-full text-sm font-semibold">{{ $location->hostels_count }} hostels</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                    <a href="{{ route('admin.locations.edit', $location->id) }}" class="text-blue-600 hover:text-blue-800 font-medium mr-3">Edit</a>
                    <form action="{{ route('admin.locations.destroy', $location->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Delete this location? All hostels under it will also be deleted.')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                    <div class="text-5xl mb-4">📍</div>
                    <p class="text-lg">No locations found. Add your first location to get started.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $locations->links() }}
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Students</h1>
        <p class="text-gray-600 mt-1">Manage all student admissions and records</p>
    </div>
    <a href="{{ route('admin.students.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
        + Admit Student
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hostel</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bed</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monthly Fee</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admission Date</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($students as $student)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $student->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $student->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $student->phone }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $student->bed->room->floor->hostel->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-teal-100 text-teal-800 rounded-full text-sm font-semibold">
                        {{ $student->bed->bed_number }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">₹{{ number_format($student->monthly_fee, 2) }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $student->admission_date->format('d M Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                    <a href="{{ route('admin.students.edit', $student->id) }}" class="text-blue-600 hover:text-blue-800 font-medium mr-3">Edit</a>
                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Delete this student? The assigned bed will become available.')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                    <div class="text-5xl mb-4">👨‍🎓</div>
                    <p class="text-lg">No students found. Admit your first student to get started.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $students->links() }}
</div>
@endsection

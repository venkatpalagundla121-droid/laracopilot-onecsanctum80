<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Hostel Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-teal-700 to-teal-900 text-white flex-shrink-0">
            <div class="p-6">
                <div class="flex items-center space-x-3 mb-8">
                    <span class="text-4xl">🏨</span>
                    <div>
                        <h1 class="text-xl font-bold">Hostel</h1>
                        <p class="text-teal-200 text-sm">Management</p>
                    </div>
                </div>
                
                <div class="bg-teal-800 rounded-lg p-4 mb-6">
                    <p class="text-teal-200 text-xs mb-1">Logged in as</p>
                    <p class="font-bold">{{ session('admin_name') }}</p>
                    <p class="text-teal-300 text-sm mt-1">{{ ucfirst(session('admin_role', 'admin')) }}</p>
                </div>
                
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-teal-800 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-teal-800' : '' }}">
                        <span class="text-xl">📊</span>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.locations.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-teal-800 transition-colors {{ request()->routeIs('admin.locations.*') ? 'bg-teal-800' : '' }}">
                        <span class="text-xl">📍</span>
                        <span>Locations</span>
                    </a>
                    <a href="{{ route('admin.hostels.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-teal-800 transition-colors {{ request()->routeIs('admin.hostels.*') ? 'bg-teal-800' : '' }}">
                        <span class="text-xl">🏢</span>
                        <span>Hostels</span>
                    </a>
                    <a href="{{ route('admin.floors.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-teal-800 transition-colors {{ request()->routeIs('admin.floors.*') ? 'bg-teal-800' : '' }}">
                        <span class="text-xl">🏗️</span>
                        <span>Floors</span>
                    </a>
                    <a href="{{ route('admin.rooms.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-teal-800 transition-colors {{ request()->routeIs('admin.rooms.*') ? 'bg-teal-800' : '' }}">
                        <span class="text-xl">🚪</span>
                        <span>Rooms</span>
                    </a>
                    <a href="{{ route('admin.beds.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-teal-800 transition-colors {{ request()->routeIs('admin.beds.*') ? 'bg-teal-800' : '' }}">
                        <span class="text-xl">🛏️</span>
                        <span>Beds</span>
                    </a>
                    <a href="{{ route('admin.students.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-teal-800 transition-colors {{ request()->routeIs('admin.students.*') ? 'bg-teal-800' : '' }}">
                        <span class="text-xl">👨‍🎓</span>
                        <span>Students</span>
                    </a>
                    <a href="{{ route('admin.financial.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-teal-800 transition-colors {{ request()->routeIs('admin.financial.*') ? 'bg-teal-800' : '' }}">
                        <span class="text-xl">💰</span>
                        <span>Financial</span>
                    </a>
                    <a href="{{ route('admin.bed-availability.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-teal-800 transition-colors {{ request()->routeIs('admin.bed-availability.*') ? 'bg-teal-800' : '' }}">
                        <span class="text-xl">✅</span>
                        <span>Bed Availability</span>
                    </a>
                </nav>
                
                <div class="mt-8">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-red-600 transition-colors bg-red-500">
                            <span class="text-xl">🚪</span>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>

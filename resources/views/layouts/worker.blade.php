<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Dashboard - Hostel Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Top Navigation -->
    <nav class="bg-gradient-to-r from-teal-700 to-teal-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <span class="text-3xl">🏨</span>
                    <div>
                        <h1 class="text-xl font-bold">Hostel Management</h1>
                        <p class="text-teal-200 text-sm">Worker Dashboard</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-6">
                    <div class="text-right">
                        <p class="text-teal-200 text-xs">Logged in as</p>
                        <p class="font-bold">{{ session('admin_name') }}</p>
                        <p class="text-teal-300 text-xs">Worker (Read-Only)</p>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg font-semibold transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center">
            <p>© {{ date('Y') }} Hostel Management System. All rights reserved.</p>
            <p class="mt-2 text-sm">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="text-teal-400 hover:underline">LaraCopilot</a></p>
        </div>
    </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Hostel Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-teal-500 to-cyan-700 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="text-6xl mb-4">🏨</div>
            <h1 class="text-4xl font-bold text-white mb-2">Hostel Management</h1>
            <p class="text-teal-100 text-lg">Admin & Worker Portal</p>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Sign In</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="bg-teal-50 border border-teal-200 rounded-lg p-4 mb-6">
                <h3 class="font-bold text-teal-800 mb-3 flex items-center">
                    <span class="mr-2">🔑</span> Test Credentials (Database)
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="bg-white rounded p-3 border border-teal-200">
                        <p class="font-semibold text-gray-800 mb-1">Super Admin:</p>
                        <p class="text-gray-600">Email: <span class="font-mono bg-gray-100 px-2 py-1 rounded">superadmin@hostel.com</span></p>
                        <p class="text-gray-600">Password: <span class="font-mono bg-gray-100 px-2 py-1 rounded">superadmin123</span></p>
                    </div>
                    <div class="bg-white rounded p-3 border border-teal-200">
                        <p class="font-semibold text-gray-800 mb-1">Admin:</p>
                        <p class="text-gray-600">Email: <span class="font-mono bg-gray-100 px-2 py-1 rounded">admin@hostel.com</span></p>
                        <p class="text-gray-600">Password: <span class="font-mono bg-gray-100 px-2 py-1 rounded">admin123</span></p>
                    </div>
                    <div class="bg-white rounded p-3 border border-teal-200">
                        <p class="font-semibold text-gray-800 mb-1">Worker (Read-Only):</p>
                        <p class="text-gray-600">Email: <span class="font-mono bg-gray-100 px-2 py-1 rounded">worker@hostel.com</span></p>
                        <p class="text-gray-600">Password: <span class="font-mono bg-gray-100 px-2 py-1 rounded">worker123</span></p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Email Address</label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('email') border-red-500 @enderror" 
                        placeholder="Enter your email"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500 @error('password') border-red-500 @enderror" 
                        placeholder="Enter your password"
                        required
                    >
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-teal-600 shadow-sm focus:border-teal-300 focus:ring focus:ring-teal-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 rounded-lg transition-colors duration-200"
                >
                    Sign In
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ url('/') }}" class="text-teal-600 hover:text-teal-800 text-sm font-semibold">
                    ← Back to Home
                </a>
            </div>
        </div>

        <div class="text-center mt-6 text-white text-sm">
            <p>© {{ date('Y') }} Hostel Management System</p>
            <p class="mt-1">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="underline hover:text-teal-200">LaraCopilot</a></p>
        </div>
    </div>
</body>
</html>

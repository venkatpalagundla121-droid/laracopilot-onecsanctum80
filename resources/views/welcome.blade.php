<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <span class="text-3xl">🏨</span>
                <h1 class="text-2xl font-bold text-teal-700">Hostel Management System</h1>
            </div>
            <a href="{{ route('admin.login') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg font-semibold transition-colors">
                Admin Login
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-teal-500 to-cyan-700 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-5xl font-bold mb-6">Complete Hostel Management Solution</h2>
            <p class="text-xl mb-8 text-teal-100">Manage multiple locations, hostels, rooms, beds, and students with ease</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('admin.login') }}" class="bg-white text-teal-700 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition-colors">
                    Get Started
                </a>
                <a href="#features" class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-teal-700 transition-colors">
                    Learn More
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Key Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition-shadow">
                    <div class="text-5xl mb-4">📍</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Multi-Location Management</h3>
                    <p class="text-gray-600">Manage hostels across multiple cities and locations from a single dashboard. Perfect for multi-campus organizations.</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition-shadow">
                    <div class="text-5xl mb-4">🛏️</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Bed Assignment System</h3>
                    <p class="text-gray-600">Intelligent bed allocation with real-time availability tracking. Prevent double bookings and optimize occupancy.</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition-shadow">
                    <div class="text-5xl mb-4">💰</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Financial Dashboard</h3>
                    <p class="text-gray-600">Track income, expenses, and profitability with detailed monthly reports and category-wise breakdowns.</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition-shadow">
                    <div class="text-5xl mb-4">👨‍🎓</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Student Management</h3>
                    <p class="text-gray-600">Complete student records with guardian information, admission dates, and monthly fee tracking.</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition-shadow">
                    <div class="text-5xl mb-4">📊</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Real-Time Analytics</h3>
                    <p class="text-gray-600">Get instant insights on occupancy rates, revenue, and hostel performance with visual dashboards.</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition-shadow">
                    <div class="text-5xl mb-4">👷</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Role-Based Access</h3>
                    <p class="text-gray-600">Admin and worker roles with different permission levels. Workers get read-only access to bed availability.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-gray-800 mb-6">Built for Modern Hostel Operations</h2>
                    <p class="text-gray-600 text-lg mb-4">
                        Our hostel management system is designed to handle the complexity of multi-location operations while remaining simple and intuitive to use.
                    </p>
                    <p class="text-gray-600 text-lg mb-4">
                        From tracking bed availability across multiple hostels to managing finances and student records, everything is centralized in one powerful platform.
                    </p>
                    <p class="text-gray-600 text-lg">
                        Whether you manage a single hostel or a network of properties, our system scales with your needs.
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-xl p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">System Capabilities</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <span class="text-teal-600 mr-3 text-2xl">✓</span>
                            <span class="text-gray-700">Unlimited locations, hostels, and beds</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-teal-600 mr-3 text-2xl">✓</span>
                            <span class="text-gray-700">Hierarchical structure: Location → Hostel → Floor → Room → Bed</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-teal-600 mr-3 text-2xl">✓</span>
                            <span class="text-gray-700">Automated bed occupancy tracking</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-teal-600 mr-3 text-2xl">✓</span>
                            <span class="text-gray-700">Financial income and expense management</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-teal-600 mr-3 text-2xl">✓</span>
                            <span class="text-gray-700">Real-time availability dashboard</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-teal-600 mr-3 text-2xl">✓</span>
                            <span class="text-gray-700">Worker read-only access for inquiries</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-gradient-to-r from-teal-600 to-cyan-600 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-5xl font-bold mb-2">100%</div>
                    <div class="text-teal-100">Automated Tracking</div>
                </div>
                <div>
                    <div class="text-5xl font-bold mb-2">24/7</div>
                    <div class="text-teal-100">Real-Time Updates</div>
                </div>
                <div>
                    <div class="text-5xl font-bold mb-2">Multi</div>
                    <div class="text-teal-100">Location Support</div>
                </div>
                <div>
                    <div class="text-5xl font-bold mb-2">∞</div>
                    <div class="text-teal-100">Unlimited Capacity</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">Ready to Get Started?</h2>
            <p class="text-xl text-gray-600 mb-8">
                Transform your hostel management operations with our comprehensive solution. Get started today!
            </p>
            <a href="{{ route('admin.login') }}" class="inline-block bg-teal-600 hover:bg-teal-700 text-white px-12 py-4 rounded-lg font-bold text-lg transition-colors">
                Access Admin Panel
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Hostel Management</h3>
                    <p class="text-gray-400">Complete solution for managing hostels, students, and finances across multiple locations.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Features</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>Multi-Location Support</li>
                        <li>Bed Management</li>
                        <li>Student Records</li>
                        <li>Financial Tracking</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('admin.login') }}" class="hover:text-white">Admin Login</a></li>
                        <li><a href="#features" class="hover:text-white">Features</a></li>
                        <li><a href="#" class="hover:text-white">Documentation</a></li>
                        <li><a href="#" class="hover:text-white">Support</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>📧 info@hostelmanagement.com</li>
                        <li>📞 +91-1234567890</li>
                        <li>📍 Multiple Locations</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>© {{ date('Y') }} Hostel Management System. All rights reserved.</p>
                <p class="mt-2">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="text-teal-400 hover:underline">LaraCopilot</a></p>
            </div>
        </div>
    </footer>
</body>
</html>

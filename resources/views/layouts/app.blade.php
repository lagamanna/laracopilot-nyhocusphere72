<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Request & Document Management - @yield('title', 'Home')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <nav class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-file-alt text-2xl mr-3"></i>
                    <span class="font-bold text-xl">ServiceDoc System</span>
                </div>
                <div class="flex items-center space-x-4">
                    @if(session('user_logged_in'))
                        <a href="{{ route('dashboard') }}" class="hover:bg-white/20 px-3 py-2 rounded transition">Dashboard</a>
                        <a href="{{ route('service-requests.index') }}" class="hover:bg-white/20 px-3 py-2 rounded transition">My Requests</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="hover:bg-white/20 px-3 py-2 rounded transition">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:bg-white/20 px-3 py-2 rounded transition">Login</a>
                        <a href="{{ route('register') }}" class="bg-white text-indigo-600 hover:bg-gray-100 px-4 py-2 rounded font-semibold transition">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4">ServiceDoc System</h3>
                <p class="text-gray-400 text-sm">Professional service request and document management platform for seamless workflow.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Services</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="#" class="hover:text-white transition">Document Verification</a></li>
                    <li><a href="#" class="hover:text-white transition">Draft Management</a></li>
                    <li><a href="#" class="hover:text-white transition">Payment Processing</a></li>
                    <li><a href="#" class="hover:text-white transition">Consultation Services</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Support</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                    <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                    <li><a href="#" class="hover:text-white transition">FAQs</a></li>
                    <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Contact</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><i class="fas fa-envelope mr-2"></i>support@servicedoc.com</li>
                    <li><i class="fas fa-phone mr-2"></i>+1 (555) 123-4567</li>
                    <li><i class="fas fa-map-marker-alt mr-2"></i>123 Business St, City</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 py-6 text-center text-sm">
            <p>© {{ date('Y') }} ServiceDoc System. All rights reserved.</p>
            <p class="mt-2">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="hover:underline">LaraCopilot</a></p>
        </div>
    </footer>
</body>
</html>

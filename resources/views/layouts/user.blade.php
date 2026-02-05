<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Dashboard') - Service Request System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white flex-shrink-0">
            <div class="p-6">
                <div class="flex items-center mb-8">
                    <div class="bg-white bg-opacity-20 p-3 rounded-lg mr-3">
                        <i class="fas fa-briefcase text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Service Portal</h1>
                        <p class="text-xs text-blue-200">User Dashboard</p>
                    </div>
                </div>

                <!-- User Info -->
                <div class="bg-white bg-opacity-10 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <div class="bg-white bg-opacity-20 w-12 h-12 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-user text-xl"></i>
                        </div>
                        <div>
                            <p class="font-semibold">{{ session('user_name', 'User') }}</p>
                            <p class="text-xs text-blue-200">{{ session('user_email', 'user@example.com') }}</p>
                        </div>
                    </div>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('user.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('user.dashboard') ? 'bg-white bg-opacity-20' : 'hover:bg-white hover:bg-opacity-10' }} transition">
                        <i class="fas fa-home w-6"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('user.requests.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('user.requests.*') ? 'bg-white bg-opacity-20' : 'hover:bg-white hover:bg-opacity-10' }} transition">
                        <i class="fas fa-file-alt w-6"></i>
                        <span>My Requests</span>
                    </a>
                    <a href="{{ route('user.requests.create') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('user.requests.create') ? 'bg-white bg-opacity-20' : 'hover:bg-white hover:bg-opacity-10' }} transition">
                        <i class="fas fa-plus-circle w-6"></i>
                        <span>New Request</span>
                    </a>
                    <a href="{{ route('user.documents.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('user.documents.*') ? 'bg-white bg-opacity-20' : 'hover:bg-white hover:bg-opacity-10' }} transition">
                        <i class="fas fa-folder w-6"></i>
                        <span>Documents</span>
                    </a>
                    <a href="{{ route('user.payments.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('user.payments.*') ? 'bg-white bg-opacity-20' : 'hover:bg-white hover:bg-opacity-10' }} transition">
                        <i class="fas fa-credit-card w-6"></i>
                        <span>Payments</span>
                    </a>
                    <a href="{{ route('user.schedule.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('user.schedule.*') ? 'bg-white bg-opacity-20' : 'hover:bg-white hover:bg-opacity-10' }} transition">
                        <i class="fas fa-calendar w-6"></i>
                        <span>Call Schedule</span>
                    </a>
                    <a href="{{ route('user.profile') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('user.profile') ? 'bg-white bg-opacity-20' : 'hover:bg-white hover:bg-opacity-10' }} transition">
                        <i class="fas fa-user-circle w-6"></i>
                        <span>Profile</span>
                    </a>
                </nav>
            </div>

            <div class="absolute bottom-0 w-64 p-6">
                <form action="{{ route('user.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-red-500 hover:bg-red-600 rounded-lg transition">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="px-6 py-4 flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-800">@yield('title', 'Dashboard')</h2>
                    <div class="flex items-center space-x-4">
                        <button class="relative text-gray-600 hover:text-gray-800">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                        </button>
                        <div class="flex items-center">
                            <div class="bg-blue-100 w-10 h-10 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ session('user_name', 'User') }}</p>
                                <p class="text-xs text-gray-600">User Account</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>

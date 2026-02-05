<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Service Request System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-indigo-600 to-purple-700 text-white flex-shrink-0">
            <div class="p-6 border-b border-indigo-500">
                <h1 class="text-2xl font-bold">Admin Panel</h1>
                <p class="text-indigo-200 text-sm mt-1">Service Request System</p>
            </div>
            
            <nav class="p-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('admin.service-requests.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.service-requests.*') ? 'bg-white/20' : '' }}">
                    <i class="fas fa-clipboard-list mr-3"></i>
                    <span>Service Requests</span>
                </a>
                
                <a href="{{ route('admin.documents.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.documents.*') ? 'bg-white/20' : '' }}">
                    <i class="fas fa-file-alt mr-3"></i>
                    <span>Documents</span>
                </a>
                
                <a href="{{ route('admin.drafts.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.drafts.*') ? 'bg-white/20' : '' }}">
                    <i class="fas fa-file-pdf mr-3"></i>
                    <span>Drafts</span>
                </a>
                
                <a href="{{ route('admin.payments.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.payments.*') ? 'bg-white/20' : '' }}">
                    <i class="fas fa-credit-card mr-3"></i>
                    <span>Payments</span>
                </a>
                
                <a href="{{ route('admin.call-schedule.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.call-schedule.*') ? 'bg-white/20' : '' }}">
                    <i class="fas fa-phone mr-3"></i>
                    <span>Call Schedule</span>
                </a>
                
                <a href="{{ route('admin.feedback.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.feedback.*') ? 'bg-white/20' : '' }}">
                    <i class="fas fa-comments mr-3"></i>
                    <span>Feedback</span>
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.users.*') ? 'bg-white/20' : '' }}">
                    <i class="fas fa-users mr-3"></i>
                    <span>Users</span>
                </a>
                
                <a href="{{ route('admin.service-types.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.service-types.*') ? 'bg-white/20' : '' }}">
                    <i class="fas fa-cogs mr-3"></i>
                    <span>Service Types</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <i class="fas fa-bars text-gray-600 text-xl mr-4 cursor-pointer"></i>
                        <h2 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <i class="fas fa-bell text-gray-600 text-xl cursor-pointer"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="bg-indigo-600 text-white w-10 h-10 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ session('admin_user', 'Admin') }}</p>
                                <p class="text-sm text-gray-500">Administrator</p>
                            </div>
                        </div>
                        
                        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>

@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
        <p class="text-gray-600 mt-2">Welcome back, {{ session('admin_user') }}! Here's your overview.</p>
    </div>

    <!-- Main Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Service Requests -->
        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold">Total Requests</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalRequests }}</p>
                    <p class="text-sm text-gray-600 mt-1">All time</p>
                </div>
                <div class="bg-blue-100 p-4 rounded-full">
                    <i class="fas fa-clipboard-list text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Pending Requests -->
        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold">Pending Review</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $pendingRequests }}</p>
                    <p class="text-sm text-gray-600 mt-1">Needs attention</p>
                </div>
                <div class="bg-yellow-100 p-4 rounded-full">
                    <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold">Total Users</p>
                    <p class="text-3xl font-bold text-green-600">{{ $totalUsers }}</p>
                    <p class="text-sm text-gray-600 mt-1">{{ $activeUsers }} active</p>
                </div>
                <div class="bg-green-100 p-4 rounded-full">
                    <i class="fas fa-users text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Completed Requests -->
        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold">Completed</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $completedRequests }}</p>
                    <p class="text-sm text-gray-600 mt-1">Successfully done</p>
                </div>
                <div class="bg-blue-100 p-4 rounded-full">
                    <i class="fas fa-check-circle text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Request Status Breakdown -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-center">
                <p class="text-2xl font-bold text-yellow-600">{{ $pendingRequests }}</p>
                <p class="text-sm text-gray-600">Pending</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-center">
                <p class="text-2xl font-bold text-green-600">{{ $approvedRequests }}</p>
                <p class="text-sm text-gray-600">Approved</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-center">
                <p class="text-2xl font-bold text-purple-600">{{ $inProgressRequests }}</p>
                <p class="text-sm text-gray-600">In Progress</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-center">
                <p class="text-2xl font-bold text-red-600">{{ $rejectedRequests }}</p>
                <p class="text-sm text-gray-600">Rejected</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-center">
                <p class="text-2xl font-bold text-blue-600">{{ $completedRequests }}</p>
                <p class="text-sm text-gray-600">Completed</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.service-requests.index', ['status' => 'pending']) }}" 
               class="bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-bold py-4 px-6 rounded-lg flex items-center justify-center space-x-3 transition duration-300 transform hover:scale-105">
                <i class="fas fa-tasks text-2xl"></i>
                <span>Review Pending Requests</span>
            </a>
            <a href="{{ route('admin.service-requests.index') }}" 
               class="bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-bold py-4 px-6 rounded-lg flex items-center justify-center space-x-3 transition duration-300 transform hover:scale-105">
                <i class="fas fa-list-alt text-2xl"></i>
                <span>All Service Requests</span>
            </a>
            <a href="{{ route('admin.service-requests.index', ['status' => 'approved']) }}" 
               class="bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 text-white font-bold py-4 px-6 rounded-lg flex items-center justify-center space-x-3 transition duration-300 transform hover:scale-105">
                <i class="fas fa-check-double text-2xl"></i>
                <span>Approved Requests</span>
            </a>
        </div>
    </div>

    <!-- Recent Requests -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800">Recent Service Requests</h2>
            <a href="{{ route('admin.service-requests.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                View All <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        
        @if($recentRequests->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($recentRequests as $request)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $request->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $request->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $request->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $request->serviceType->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($request->title, 40) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                @if($request->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($request->status === 'approved') bg-green-100 text-green-800
                                @elseif($request->status === 'rejected') bg-red-100 text-red-800
                                @elseif($request->status === 'completed') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($request->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $request->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.service-requests.show', $request->id) }}" 
                               class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-eye mr-1"></i>Review
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
            <p class="text-gray-500 text-lg">No recent service requests</p>
        </div>
        @endif
    </div>
</div>
@endsection

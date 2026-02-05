@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8">
    <div class="container mx-auto px-4">
        <!-- Welcome Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Welcome back, {{ session('user_name') }}!</h1>
                    <p class="text-gray-600 mt-2">Manage your service requests and track your progress</p>
                </div>
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-4 rounded-full">
                    <i class="fas fa-user-circle text-white text-4xl"></i>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold">Total Requests</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalRequests }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-clipboard-list text-blue-600 text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold">Pending</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ $pendingRequests }}</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold">Approved</p>
                        <p class="text-3xl font-bold text-green-600">{{ $approvedRequests }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold">Completed</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $completedRequests }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-check-double text-blue-600 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('user.requests.create') }}" 
                   class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-4 px-6 rounded-lg flex items-center justify-center space-x-3 transition duration-300 transform hover:scale-105">
                    <i class="fas fa-plus-circle text-2xl"></i>
                    <span>New Service Request</span>
                </a>
                <a href="{{ route('user.requests.index') }}" 
                   class="bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white font-bold py-4 px-6 rounded-lg flex items-center justify-center space-x-3 transition duration-300 transform hover:scale-105">
                    <i class="fas fa-list-alt text-2xl"></i>
                    <span>View My Requests</span>
                </a>
                <a href="{{ route('user.documents.index') }}" 
                   class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-4 px-6 rounded-lg flex items-center justify-center space-x-3 transition duration-300 transform hover:scale-105">
                    <i class="fas fa-folder-open text-2xl"></i>
                    <span>My Documents</span>
                </a>
            </div>
        </div>

        <!-- Recent Requests -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Recent Requests</h2>
                <a href="{{ route('user.requests.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            @if($recentRequests->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request ID</th>
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
                                <a href="{{ route('user.requests.show', $request->id) }}" 
                                   class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye mr-1"></i>View
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
                <p class="text-gray-500 text-lg mb-4">No service requests yet</p>
                <a href="{{ route('user.requests.create') }}" 
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition">
                    <i class="fas fa-plus-circle mr-2"></i>Create Your First Request
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
<!-- Welcome Banner -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-8 mb-6 text-white">
    <h1 class="text-3xl font-bold mb-2">Welcome back, {{ session('user_name', 'User') }}!</h1>
    <p class="text-blue-100">Manage your service requests and track their progress from your dashboard.</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Requests</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalRequests ?? 0 }}</p>
            </div>
            <div class="bg-blue-100 p-4 rounded-full">
                <i class="fas fa-file-alt text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Pending</p>
                <p class="text-3xl font-bold text-gray-800">{{ $pendingRequests ?? 0 }}</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-full">
                <i class="fas fa-clock text-yellow-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Completed</p>
                <p class="text-3xl font-bold text-gray-800">{{ $completedRequests ?? 0 }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-full">
                <i class="fas fa-check-circle text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Documents</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalDocuments ?? 0 }}</p>
            </div>
            <div class="bg-purple-100 p-4 rounded-full">
                <i class="fas fa-folder text-purple-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('user.requests.create') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
            <div class="bg-blue-600 p-3 rounded-full mr-4">
                <i class="fas fa-plus text-white text-xl"></i>
            </div>
            <div>
                <p class="font-semibold text-gray-800">New Request</p>
                <p class="text-sm text-gray-600">Submit a service request</p>
            </div>
        </a>

        <a href="{{ route('user.documents.index') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
            <div class="bg-green-600 p-3 rounded-full mr-4">
                <i class="fas fa-upload text-white text-xl"></i>
            </div>
            <div>
                <p class="font-semibold text-gray-800">Upload Documents</p>
                <p class="text-sm text-gray-600">Upload required files</p>
            </div>
        </a>

        <a href="{{ route('user.schedule.index') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
            <div class="bg-purple-600 p-3 rounded-full mr-4">
                <i class="fas fa-calendar text-white text-xl"></i>
            </div>
            <div>
                <p class="font-semibold text-gray-800">Schedule Call</p>
                <p class="text-sm text-gray-600">Book consultation</p>
            </div>
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Requests -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">Recent Requests</h2>
            <a href="{{ route('user.requests.index') }}" class="text-blue-600 hover:underline text-sm">View All</a>
        </div>
        @if(isset($recentRequests) && count($recentRequests) > 0)
            <div class="space-y-3">
                @foreach($recentRequests as $request)
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow transition">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-semibold text-gray-800">#{{ str_pad($request->id, 5, '0', STR_PAD_LEFT) }}</span>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold 
                            @if($request->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($request->status === 'approved') bg-blue-100 text-blue-800
                            @elseif($request->status === 'completed') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($request->status) }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mb-1">{{ $request->service_type ?? 'Service Request' }}</p>
                    <p class="text-xs text-gray-500">{{ $request->created_at->format('M d, Y') }}</p>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-file-alt text-4xl mb-3 text-gray-300"></i>
                <p>No requests yet. Create your first request!</p>
                <a href="{{ route('user.requests.create') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                    <i class="fas fa-plus mr-2"></i>New Request
                </a>
            </div>
        @endif
    </div>

    <!-- Upcoming Calls -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">Upcoming Calls</h2>
            <a href="{{ route('user.schedule.index') }}" class="text-blue-600 hover:underline text-sm">View All</a>
        </div>
        @if(isset($upcomingCalls) && count($upcomingCalls) > 0)
            <div class="space-y-3">
                @foreach($upcomingCalls as $call)
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow transition">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-semibold text-gray-800">{{ $call->purpose ?? 'Consultation' }}</span>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                            Scheduled
                        </span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600 mb-1">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>{{ $call->scheduled_date }}</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-clock mr-2"></i>
                        <span>{{ $call->scheduled_time }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-calendar text-4xl mb-3 text-gray-300"></i>
                <p>No upcoming calls scheduled.</p>
                <a href="{{ route('user.schedule.index') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                    <i class="fas fa-calendar-plus mr-2"></i>Schedule Call
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

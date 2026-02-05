@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard Overview</h1>
    <p class="text-gray-600 mt-2">Welcome back, {{ session('admin_user', 'Admin') }}!</p>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-blue-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm font-semibold uppercase">Total Requests</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalRequests }}</p>
                <p class="text-sm text-green-600 mt-2"><i class="fas fa-arrow-up"></i> Active requests</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-clipboard-list text-2xl text-blue-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-yellow-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm font-semibold uppercase">Pending Review</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $pendingRequests }}</p>
                <p class="text-sm text-yellow-600 mt-2"><i class="fas fa-clock"></i> Needs attention</p>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-hourglass-half text-2xl text-yellow-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-green-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm font-semibold uppercase">Completed</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $completedRequests }}</p>
                <p class="text-sm text-green-600 mt-2"><i class="fas fa-check-circle"></i> This month</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-check-double text-2xl text-green-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-purple-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm font-semibold uppercase">Total Revenue</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">${{ number_format($totalRevenue, 2) }}</p>
                <p class="text-sm text-purple-600 mt-2"><i class="fas fa-dollar-sign"></i> All time</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-coins text-2xl text-purple-600"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Recent Requests -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Service Requests</h2>
        <div class="space-y-3">
            @forelse($recentRequests as $request)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                <div class="flex items-center">
                    <div class="bg-indigo-100 p-2 rounded-full mr-3">
                        <i class="fas fa-file-alt text-indigo-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">#{{ str_pad($request->id, 5, '0', STR_PAD_LEFT) }}</p>
                        <p class="text-sm text-gray-600">{{ $request->user->name ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        @if($request->status === 'completed') bg-green-100 text-green-800
                        @elseif($request->status === 'approved') bg-blue-100 text-blue-800
                        @elseif($request->status === 'in_review') bg-yellow-100 text-yellow-800
                        @elseif($request->status === 'pending') bg-orange-100 text-orange-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                    </span>
                    <p class="text-xs text-gray-500 mt-1">{{ $request->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-center py-8">No recent requests</p>
            @endforelse
        </div>
        <a href="{{ route('admin.service-requests.index') }}" class="block text-center mt-4 text-indigo-600 hover:underline font-semibold">
            View All Requests <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <!-- Pending Documents -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Pending Document Verification</h2>
        <div class="space-y-3">
            @forelse($pendingDocuments as $document)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                <div class="flex items-center">
                    <div class="bg-red-100 p-2 rounded-full mr-3">
                        <i class="fas fa-file-pdf text-red-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">{{ ucfirst(str_replace('_', ' ', $document->document_type)) }}</p>
                        <p class="text-sm text-gray-600">Request #{{ str_pad($document->service_request_id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
                <a href="{{ route('admin.documents.verify', $document->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm font-semibold transition">
                    Verify
                </a>
            </div>
            @empty
            <p class="text-gray-500 text-center py-8">All documents verified</p>
            @endforelse
        </div>
        <a href="{{ route('admin.documents.index') }}" class="block text-center mt-4 text-indigo-600 hover:underline font-semibold">
            View All Documents <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
</div>

<!-- Upcoming Calls & Recent Payments -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Upcoming Calls -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Upcoming Scheduled Calls</h2>
        <div class="space-y-3">
            @forelse($upcomingCalls as $call)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center">
                    <div class="bg-green-100 p-2 rounded-full mr-3">
                        <i class="fas fa-phone text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">{{ $call->user->name ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-600">{{ $call->contact_number }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm font-semibold text-gray-800">{{ \Carbon\Carbon::parse($call->scheduled_date)->format('M d, Y') }}</p>
                    <p class="text-xs text-gray-600">{{ \Carbon\Carbon::parse($call->scheduled_time)->format('h:i A') }}</p>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-center py-8">No upcoming calls</p>
            @endforelse
        </div>
        <a href="{{ route('admin.call-schedule.index') }}" class="block text-center mt-4 text-indigo-600 hover:underline font-semibold">
            View All Calls <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <!-- Recent Payments -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Payments</h2>
        <div class="space-y-3">
            @forelse($recentPayments as $payment)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center">
                    <div class="bg-purple-100 p-2 rounded-full mr-3">
                        <i class="fas fa-credit-card text-purple-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">${{ number_format($payment->amount, 2) }}</p>
                        <p class="text-sm text-gray-600">{{ ucfirst($payment->payment_method) }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        @if($payment->payment_status === 'completed') bg-green-100 text-green-800
                        @elseif($payment->payment_status === 'pending') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($payment->payment_status) }}
                    </span>
                    <p class="text-xs text-gray-500 mt-1">{{ $payment->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-center py-8">No recent payments</p>
            @endforelse
        </div>
        <a href="{{ route('admin.payments.index') }}" class="block text-center mt-4 text-indigo-600 hover:underline font-semibold">
            View All Payments <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
</div>
@endsection

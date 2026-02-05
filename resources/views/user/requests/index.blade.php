@extends('layouts.user')

@section('title', 'My Requests')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">My Service Requests</h1>
            <p class="text-gray-600 mt-2">View and manage all your service requests</p>
        </div>
        <a href="{{ route('user.requests.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i>New Request
        </a>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

<!-- Filter Tabs -->
<div class="bg-white rounded-lg shadow mb-6 p-4">
    <div class="flex space-x-2">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-filter mr-2"></i>All Requests
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
            <i class="fas fa-clock mr-2"></i>Pending
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
            <i class="fas fa-check mr-2"></i>Approved
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
            <i class="fas fa-check-double mr-2"></i>Completed
        </button>
    </div>
</div>

<!-- Requests List -->
@if(isset($requests) && count($requests) > 0)
    <div class="space-y-4">
        @foreach($requests as $request)
        <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-4 rounded-full mr-4">
                        <i class="fas fa-file-contract text-blue-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Request #{{ str_pad($request->id, 5, '0', STR_PAD_LEFT) }}</h3>
                        <p class="text-gray-600">{{ $request->title }}</p>
                    </div>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold 
                    @if($request->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($request->status === 'approved') bg-blue-100 text-blue-800
                    @elseif($request->status === 'completed') bg-green-100 text-green-800
                    @elseif($request->status === 'cancelled') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800 @endif">
                    <i class="fas fa-{{ $request->status === 'pending' ? 'clock' : ($request->status === 'completed' ? 'check' : 'info-circle') }} mr-1"></i>{{ ucfirst($request->status) }}
                </span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-600">Submitted Date</p>
                    <p class="font-semibold text-gray-800">{{ $request->created_at->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Priority</p>
                    <p class="font-semibold text-gray-800">{{ ucfirst($request->priority) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Contact Method</p>
                    <p class="font-semibold text-gray-800">{{ ucfirst($request->contact_method) }}</p>
                </div>
            </div>
            
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-2">Description:</p>
                <p class="text-gray-800">{{ Str::limit($request->description, 150) }}</p>
            </div>
            
            <div class="flex space-x-3">
                <a href="{{ route('user.requests.show', $request->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    <i class="fas fa-eye mr-2"></i>View Details
                </a>
                <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                    <i class="fas fa-upload mr-2"></i>Upload Documents
                </button>
                <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                    <i class="fas fa-calendar mr-2"></i>Schedule Call
                </button>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="bg-white rounded-lg shadow-lg p-12 text-center">
        <i class="fas fa-file-alt text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">No Requests Yet</h3>
        <p class="text-gray-600 mb-6">You haven't submitted any service requests yet.</p>
        <a href="{{ route('user.requests.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i>Create Your First Request
        </a>
    </div>
@endif
@endsection

@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.service-requests.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i>Back to Requests
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Request Details -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Service Request #{{ $request->id }}</h1>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                        @if($request->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($request->status === 'approved') bg-green-100 text-green-800
                        @elseif($request->status === 'rejected') bg-red-100 text-red-800
                        @elseif($request->status === 'completed') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($request->status) }}
                    </span>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Service Type</label>
                        <p class="text-gray-800">{{ $request->serviceType->name }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-600">Title</label>
                        <p class="text-gray-800">{{ $request->title }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-600">Description</label>
                        <p class="text-gray-800 whitespace-pre-wrap">{{ $request->description }}</p>
                    </div>

                    @if($request->notes)
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Additional Notes</label>
                        <p class="text-gray-800 whitespace-pre-wrap">{{ $request->notes }}</p>
                    </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-semibold text-gray-600">Priority</label>
                            <p>
                                <span class="px-2 py-1 text-sm font-semibold rounded-full
                                    @if($request->priority === 'urgent') bg-red-100 text-red-800
                                    @elseif($request->priority === 'high') bg-orange-100 text-orange-800
                                    @elseif($request->priority === 'normal') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($request->priority) }}
                                </span>
                            </p>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Contact Method</label>
                            <p class="text-gray-800">{{ ucfirst($request->contact_method) }}</p>
                        </div>
                    </div>

                    @if($request->location)
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Location</label>
                        <p class="text-gray-800">{{ $request->location }}</p>
                    </div>
                    @endif

                    @if($request->admin_comment)
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <label class="text-sm font-semibold text-red-800">Admin Rejection Comment</label>
                        <p class="text-red-700 mt-1">{{ $request->admin_comment }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Attached Documents -->
            @if($request->documents->count() > 0)
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Attached Documents</h2>
                <div class="space-y-3">
                    @foreach($request->documents as $document)
                    <div class="flex items-center justify-between border rounded-lg p-4 hover:bg-gray-50">
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-100 p-3 rounded">
                                <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $document->file_name }}</p>
                                <p class="text-sm text-gray-500">{{ number_format($document->file_size / 1024, 2) }} KB</p>
                            </div>
                        </div>
                        <a href="{{ route('user.documents.download', $document->id) }}" 
                           class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Client Information -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Client Information</h2>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Name</label>
                        <p class="text-gray-800">{{ $request->user->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Email</label>
                        <p class="text-gray-800">{{ $request->user->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Phone</label>
                        <p class="text-gray-800">{{ $request->user->phone ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Submitted</label>
                        <p class="text-gray-800">{{ $request->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                    @if($request->reviewed_at)
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Reviewed</label>
                        <p class="text-gray-800">{{ $request->reviewed_at->format('M d, Y h:i A') }}</p>
                        <p class="text-sm text-gray-600">By: {{ $request->reviewed_by }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            @if($request->status === 'pending')
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Actions</h2>
                
                <!-- Approve Button -->
                <form action="{{ route('admin.service-requests.approve', $request->id) }}" method="POST" class="mb-3">
                    @csrf
                    <button type="submit" 
                            onclick="return confirm('Are you sure you want to approve this request?')"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition">
                        <i class="fas fa-check-circle mr-2"></i>Approve Request
                    </button>
                </form>

                <!-- Reject Button with Comment -->
                <button onclick="document.getElementById('rejectModal').classList.remove('hidden')" 
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg transition">
                    <i class="fas fa-times-circle mr-2"></i>Reject Request
                </button>
            </div>
            @elseif($request->status === 'approved')
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Actions</h2>
                
                <form action="{{ route('admin.service-requests.complete', $request->id) }}" method="POST">
                    @csrf
                    <button type="submit" 
                            onclick="return confirm('Mark this request as completed?')"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition">
                        <i class="fas fa-check-double mr-2"></i>Mark as Completed
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full mx-4">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Reject Service Request</h3>
        <form action="{{ route('admin.service-requests.reject', $request->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Rejection Comment (Required)</label>
                <textarea name="admin_comment" 
                          rows="6" 
                          class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500" 
                          placeholder="Explain why this request is being rejected and what the client needs to do..."
                          required></textarea>
                <p class="text-sm text-gray-600 mt-2">Minimum 10 characters</p>
            </div>
            <div class="flex space-x-3">
                <button type="button" 
                        onclick="document.getElementById('rejectModal').classList.add('hidden')"
                        class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 rounded-lg transition">
                    Cancel
                </button>
                <button type="submit" 
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded-lg transition">
                    Reject Request
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

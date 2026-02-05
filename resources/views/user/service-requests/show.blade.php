@extends('layouts.app')

@section('title', 'Request Details')

@section('content')
<div class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-4xl font-bold">Request #{{ str_pad($request->id, 5, '0', STR_PAD_LEFT) }}</h1>
        <p class="text-indigo-100 mt-2">Service request details and status</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $request->serviceType->name ?? 'N/A' }}</h2>
                        <p class="text-gray-600">Submitted on {{ $request->created_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                    <span class="px-4 py-2 rounded-full text-sm font-semibold
                        @if($request->status === 'completed') bg-green-100 text-green-800
                        @elseif($request->status === 'approved') bg-blue-100 text-blue-800
                        @elseif($request->status === 'in_review') bg-yellow-100 text-yellow-800
                        @elseif($request->status === 'pending') bg-orange-100 text-orange-800
                        @elseif($request->status === 'rejected') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                    </span>
                </div>

                <div class="border-t pt-6">
                    <h3 class="font-bold text-gray-800 mb-3">Description</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $request->description }}</p>
                </div>

                @if($request->notes)
                <div class="border-t pt-6 mt-6">
                    <h3 class="font-bold text-gray-800 mb-3">Additional Notes</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $request->notes }}</p>
                </div>
                @endif

                @if($request->admin_remarks)
                <div class="border-t pt-6 mt-6">
                    <h3 class="font-bold text-gray-800 mb-3">Admin Remarks</h3>
                    <div class="bg-blue-50 border border-blue-200 rounded p-4">
                        <p class="text-gray-700">{{ $request->admin_remarks }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Documents Section -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="font-bold text-gray-800 mb-4 text-xl">Uploaded Documents</h3>
                @if($request->documents->count() > 0)
                    <div class="space-y-3">
                        @foreach($request->documents as $document)
                        <div class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50">
                            <div class="flex items-center">
                                <i class="fas fa-file-alt text-3xl text-indigo-600 mr-4"></i>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ ucfirst(str_replace('_', ' ', $document->document_type)) }}</p>
                                    <p class="text-sm text-gray-500">{{ $document->file_name }}</p>
                                    <span class="px-2 py-1 rounded text-xs font-semibold mt-1 inline-block
                                        @if($document->verification_status === 'approved') bg-green-100 text-green-800
                                        @elseif($document->verification_status === 'rejected') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                        {{ ucfirst($document->verification_status) }}
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('documents.download', $document->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">No documents uploaded yet</p>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h3 class="font-bold text-gray-800 mb-4">Request Information</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Priority</p>
                        <span class="px-3 py-1 rounded text-sm font-semibold
                            @if($request->priority === 'high') bg-red-100 text-red-800
                            @elseif($request->priority === 'medium') bg-yellow-100 text-yellow-800
                            @else bg-green-100 text-green-800 @endif">
                            {{ ucfirst($request->priority) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Service Price</p>
                        <p class="font-bold text-gray-800">${{ number_format($request->serviceType->price ?? 0, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Last Updated</p>
                        <p class="font-semibold text-gray-800">{{ $request->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-6">
                <h3 class="font-bold text-indigo-900 mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    @if($request->status === 'pending' || $request->status === 'in_review')
                    <a href="{{ route('documents.upload', $request->id) }}" class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white text-center px-4 py-2 rounded transition">
                        <i class="fas fa-upload mr-2"></i>Upload Document
                    </a>
                    @endif
                    @if($request->status === 'approved')
                    <a href="{{ route('payments.create', ['service_request_id' => $request->id]) }}" class="block w-full bg-green-600 hover:bg-green-700 text-white text-center px-4 py-2 rounded transition">
                        <i class="fas fa-credit-card mr-2"></i>Make Payment
                    </a>
                    @endif
                    <a href="{{ route('service-requests.index') }}" class="block w-full bg-gray-300 hover:bg-gray-400 text-gray-800 text-center px-4 py-2 rounded transition">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Requests
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

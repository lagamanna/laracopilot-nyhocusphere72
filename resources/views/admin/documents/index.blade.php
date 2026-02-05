@extends('layouts.admin')

@section('title', 'Documents')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Document Management</h1>
    <p class="text-gray-600 mt-2">Review and verify uploaded documents</p>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <div class="flex space-x-2">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-filter mr-2"></i>All Documents
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                <i class="fas fa-clock mr-2"></i>Pending
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                <i class="fas fa-check mr-2"></i>Verified
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                <i class="fas fa-times mr-2"></i>Rejected
            </button>
        </div>
        <div>
            <input type="text" placeholder="Search documents..." class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-red-100 p-3 rounded-full">
                    <i class="fas fa-file-pdf text-red-600 text-2xl"></i>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                    Pending
                </span>
            </div>
            <h3 class="font-bold text-gray-800 mb-2">Identity Proof</h3>
            <p class="text-sm text-gray-600 mb-4">Uploaded by John Doe</p>
            <div class="flex justify-between items-center">
                <span class="text-xs text-gray-500">{{ now()->format('M d, Y') }}</span>
                <div class="flex space-x-2">
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-sm transition">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm transition">
                        <i class="fas fa-check"></i>
                    </button>
                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 text-center text-gray-500">
        <p>No documents found. Uploaded documents will appear here for verification.</p>
    </div>
</div>
@endsection

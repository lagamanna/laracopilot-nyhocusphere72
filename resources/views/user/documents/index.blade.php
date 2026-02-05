@extends('layouts.user')

@section('title', 'My Documents')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">My Documents</h1>
            <p class="text-gray-600 mt-2">View and manage all your uploaded documents</p>
        </div>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
            <i class="fas fa-upload mr-2"></i>Upload Document
        </button>
    </div>
</div>

<!-- Document Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Documents</p>
                <p class="text-2xl font-bold text-gray-800">0</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-file text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Verified</p>
                <p class="text-2xl font-bold text-gray-800">0</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Pending</p>
                <p class="text-2xl font-bold text-gray-800">0</p>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-clock text-yellow-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Storage Used</p>
                <p class="text-2xl font-bold text-gray-800">0 MB</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-database text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div class="bg-white rounded-lg shadow mb-6 p-4">
    <div class="flex space-x-2">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-filter mr-2"></i>All Documents
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
            <i class="fas fa-check mr-2"></i>Verified
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
            <i class="fas fa-clock mr-2"></i>Pending
        </button>
        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
            <i class="fas fa-times mr-2"></i>Rejected
        </button>
    </div>
</div>

<!-- Documents Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-red-100 p-4 rounded-full">
                <i class="fas fa-file-pdf text-red-600 text-3xl"></i>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                <i class="fas fa-check mr-1"></i>Verified
            </span>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">Identity_Proof.pdf</h3>
        <p class="text-sm text-gray-600 mb-4">Uploaded: {{ now()->format('M d, Y') }}</p>
        <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
            <span><i class="fas fa-file-alt mr-1"></i>Request #00001</span>
            <span>2.4 MB</span>
        </div>
        <div class="flex space-x-2">
            <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm transition">
                <i class="fas fa-eye mr-1"></i>View
            </button>
            <button class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded-lg text-sm transition">
                <i class="fas fa-download mr-1"></i>Download
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-blue-100 p-4 rounded-full">
                <i class="fas fa-file-word text-blue-600 text-3xl"></i>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                <i class="fas fa-clock mr-1"></i>Pending
            </span>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">Contract_Draft.docx</h3>
        <p class="text-sm text-gray-600 mb-4">Uploaded: {{ now()->format('M d, Y') }}</p>
        <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
            <span><i class="fas fa-file-alt mr-1"></i>Request #00002</span>
            <span>1.8 MB</span>
        </div>
        <div class="flex space-x-2">
            <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm transition">
                <i class="fas fa-eye mr-1"></i>View
            </button>
            <button class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded-lg text-sm transition">
                <i class="fas fa-download mr-1"></i>Download
            </button>
        </div>
    </div>
</div>

<div class="mt-6 text-center text-gray-500">
    <p>Sample documents shown. Your uploaded documents will appear here.</p>
</div>
@endsection

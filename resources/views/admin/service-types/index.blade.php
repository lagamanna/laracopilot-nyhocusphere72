@extends('layouts.admin')

@section('title', 'Service Types')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Service Type Management</h1>
    <p class="text-gray-600 mt-2">Configure available service types and pricing</p>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <div class="flex space-x-2">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-filter mr-2"></i>All Services
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                <i class="fas fa-check mr-2"></i>Active
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                <i class="fas fa-times mr-2"></i>Inactive
            </button>
        </div>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i>Add Service Type
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-indigo-100 p-3 rounded-full">
                    <i class="fas fa-file-contract text-indigo-600 text-2xl"></i>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                    Active
                </span>
            </div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">Document Verification</h3>
            <p class="text-sm text-gray-600 mb-4">Professional document verification and notarization services</p>
            <div class="flex items-center justify-between mb-4">
                <span class="text-2xl font-bold text-indigo-600">$150.00</span>
                <span class="text-sm text-gray-500">Base Price</span>
            </div>
            <div class="flex space-x-2">
                <button class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded text-sm transition">
                    <i class="fas fa-edit mr-1"></i>Edit
                </button>
                <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded text-sm transition">
                    <i class="fas fa-cog"></i>
                </button>
            </div>
        </div>

        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-gavel text-blue-600 text-2xl"></i>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                    Active
                </span>
            </div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">Legal Drafting</h3>
            <p class="text-sm text-gray-600 mb-4">Custom legal document drafting and review services</p>
            <div class="flex items-center justify-between mb-4">
                <span class="text-2xl font-bold text-blue-600">$300.00</span>
                <span class="text-sm text-gray-500">Base Price</span>
            </div>
            <div class="flex space-x-2">
                <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm transition">
                    <i class="fas fa-edit mr-1"></i>Edit
                </button>
                <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded text-sm transition">
                    <i class="fas fa-cog"></i>
                </button>
            </div>
        </div>

        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-balance-scale text-green-600 text-2xl"></i>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                    Active
                </span>
            </div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">Legal Consultation</h3>
            <p class="text-sm text-gray-600 mb-4">Expert legal advice and consultation sessions</p>
            <div class="flex items-center justify-between mb-4">
                <span class="text-2xl font-bold text-green-600">$200.00</span>
                <span class="text-sm text-gray-500">Per Hour</span>
            </div>
            <div class="flex space-x-2">
                <button class="flex-1 bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded text-sm transition">
                    <i class="fas fa-edit mr-1"></i>Edit
                </button>
                <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded text-sm transition">
                    <i class="fas fa-cog"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

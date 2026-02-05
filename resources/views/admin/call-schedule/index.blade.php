@extends('layouts.admin')

@section('title', 'Call Schedule')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Call Schedule Management</h1>
    <p class="text-gray-600 mt-2">Manage and track scheduled client calls</p>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <div class="flex space-x-2">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-calendar mr-2"></i>All Calls
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                <i class="fas fa-clock mr-2"></i>Upcoming
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                <i class="fas fa-check mr-2"></i>Completed
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                <i class="fas fa-times mr-2"></i>Cancelled
            </button>
        </div>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i>Schedule Call
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-phone text-green-600 text-xl"></i>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                    Scheduled
                </span>
            </div>
            <h3 class="font-bold text-gray-800 mb-2">John Doe</h3>
            <p class="text-sm text-gray-600 mb-2">+1 (555) 123-4567</p>
            <p class="text-sm text-gray-600 mb-4">Request #00001</p>
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-500"><i class="fas fa-calendar mr-1"></i>{{ now()->format('M d, Y') }}</span>
                <span class="text-gray-500"><i class="fas fa-clock mr-1"></i>10:00 AM</span>
            </div>
            <div class="mt-4 flex space-x-2">
                <button class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded text-sm transition">
                    <i class="fas fa-phone mr-1"></i>Call
                </button>
                <button class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded text-sm transition">
                    <i class="fas fa-edit mr-1"></i>Edit
                </button>
            </div>
        </div>
    </div>

    <div class="mt-6 text-center text-gray-500">
        <p>No scheduled calls found. Call appointments will appear here.</p>
    </div>
</div>
@endsection

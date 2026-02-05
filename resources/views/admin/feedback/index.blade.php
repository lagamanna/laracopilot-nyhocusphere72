@extends('layouts.admin')

@section('title', 'Feedback')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Customer Feedback</h1>
    <p class="text-gray-600 mt-2">Review and respond to customer feedback</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Feedback</p>
                <p class="text-2xl font-bold text-gray-800">0</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-comments text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Average Rating</p>
                <p class="text-2xl font-bold text-gray-800">0.0</p>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-star text-yellow-600 text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Positive</p>
                <p class="text-2xl font-bold text-gray-800">0</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-smile text-green-600 text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Needs Review</p>
                <p class="text-2xl font-bold text-gray-800">0</p>
            </div>
            <div class="bg-red-100 p-3 rounded-full">
                <i class="fas fa-exclamation text-red-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <div class="flex space-x-2">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-filter mr-2"></i>All Feedback
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                <i class="fas fa-star mr-2"></i>5 Stars
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                <i class="fas fa-star-half-alt mr-2"></i>3-4 Stars
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                <i class="fas fa-frown mr-2"></i>1-2 Stars
            </button>
        </div>
        <input type="text" placeholder="Search feedback..." class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div class="space-y-4">
        <div class="border border-gray-200 rounded-lg p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <div class="bg-indigo-100 w-12 h-12 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user text-indigo-600"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">John Doe</h3>
                        <p class="text-sm text-gray-600">Request #00001</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex text-yellow-400 mr-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="text-sm text-gray-500">{{ now()->format('M d, Y') }}</span>
                </div>
            </div>
            <p class="text-gray-700 mb-4">Excellent service! Very professional and quick turnaround time.</p>
            <div class="flex space-x-2">
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm transition">
                    <i class="fas fa-reply mr-1"></i>Reply
                </button>
                <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded text-sm transition">
                    <i class="fas fa-flag mr-1"></i>Flag
                </button>
            </div>
        </div>
    </div>

    <div class="mt-6 text-center text-gray-500">
        <p>No feedback received yet. Customer reviews will appear here.</p>
    </div>
</div>
@endsection

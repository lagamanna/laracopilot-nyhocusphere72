@extends('layouts.user')

@section('title', 'Call Schedule')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Call Schedule</h1>
            <p class="text-gray-600 mt-2">Manage your scheduled consultation calls</p>
        </div>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
            <i class="fas fa-calendar-plus mr-2"></i>Schedule New Call
        </button>
    </div>
</div>

<!-- Filter Tabs -->
<div class="bg-white rounded-lg shadow mb-6 p-4">
    <div class="flex space-x-2">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
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
</div>

<!-- Calls Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition border-l-4 border-blue-600">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-phone text-blue-600 text-xl"></i>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                <i class="fas fa-clock mr-1"></i>Scheduled
            </span>
        </div>
        <h3 class="font-bold text-gray-800 text-lg mb-2">Initial Consultation</h3>
        <p class="text-sm text-gray-600 mb-4">Request #00001 - Document Verification</p>
        
        <div class="space-y-2 mb-4">
            <div class="flex items-center text-sm text-gray-600">
                <i class="fas fa-calendar w-5 text-blue-600"></i>
                <span>{{ now()->addDays(3)->format('l, F d, Y') }}</span>
            </div>
            <div class="flex items-center text-sm text-gray-600">
                <i class="fas fa-clock w-5 text-blue-600"></i>
                <span>10:00 AM - 11:00 AM</span>
            </div>
            <div class="flex items-center text-sm text-gray-600">
                <i class="fas fa-video w-5 text-blue-600"></i>
                <span>Video Call</span>
            </div>
        </div>
        
        <div class="flex space-x-2">
            <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm transition">
                <i class="fas fa-video mr-1"></i>Join Call
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded-lg text-sm transition">
                <i class="fas fa-edit"></i>
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded-lg text-sm transition">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition border-l-4 border-green-600">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                <i class="fas fa-check mr-1"></i>Completed
            </span>
        </div>
        <h3 class="font-bold text-gray-800 text-lg mb-2">Follow-up Discussion</h3>
        <p class="text-sm text-gray-600 mb-4">Request #00002 - Legal Drafting</p>
        
        <div class="space-y-2 mb-4">
            <div class="flex items-center text-sm text-gray-600">
                <i class="fas fa-calendar w-5 text-green-600"></i>
                <span>{{ now()->subDays(2)->format('l, F d, Y') }}</span>
            </div>
            <div class="flex items-center text-sm text-gray-600">
                <i class="fas fa-clock w-5 text-green-600"></i>
                <span>2:00 PM - 3:00 PM</span>
            </div>
            <div class="flex items-center text-sm text-gray-600">
                <i class="fas fa-phone w-5 text-green-600"></i>
                <span>Phone Call</span>
            </div>
        </div>
        
        <div class="flex space-x-2">
            <button class="flex-1 bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm transition">
                <i class="fas fa-comment mr-1"></i>View Notes
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded-lg text-sm transition">
                <i class="fas fa-redo"></i>
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition border-l-4 border-purple-600">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-calendar-plus text-purple-600 text-xl"></i>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
                <i class="fas fa-hourglass-half mr-1"></i>Pending
            </span>
        </div>
        <h3 class="font-bold text-gray-800 text-lg mb-2">Document Review</h3>
        <p class="text-sm text-gray-600 mb-4">Request #00003 - Contract Review</p>
        
        <div class="space-y-2 mb-4">
            <div class="flex items-center text-sm text-gray-600">
                <i class="fas fa-calendar w-5 text-purple-600"></i>
                <span>To be scheduled</span>
            </div>
            <div class="flex items-center text-sm text-gray-600">
                <i class="fas fa-clock w-5 text-purple-600"></i>
                <span>Duration: 30-45 mins</span>
            </div>
            <div class="flex items-center text-sm text-gray-600">
                <i class="fas fa-video w-5 text-purple-600"></i>
                <span>Video Call</span>
            </div>
        </div>
        
        <button class="w-full bg-purple-600 hover:bg-purple-700 text-white px-3 py-2 rounded-lg text-sm transition">
            <i class="fas fa-calendar-check mr-1"></i>Schedule Now
        </button>
    </div>
</div>

<div class="mt-6 text-center text-gray-500">
    <p>Sample call schedules shown. Your actual scheduled calls will appear here.</p>
</div>
@endsection

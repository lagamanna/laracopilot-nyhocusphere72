@extends('layouts.user')

@section('title', 'My Payments')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Payment History</h1>
    <p class="text-gray-600 mt-2">View and manage your payment transactions</p>
</div>

<!-- Payment Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Spent</p>
                <p class="text-2xl font-bold text-gray-800">$0.00</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-dollar-sign text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Completed</p>
                <p class="text-2xl font-bold text-gray-800">$0.00</p>
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
                <p class="text-2xl font-bold text-gray-800">$0.00</p>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-clock text-yellow-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">This Month</p>
                <p class="text-2xl font-bold text-gray-800">$0.00</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-calendar text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filter Options -->
<div class="bg-white rounded-lg shadow mb-6 p-4">
    <div class="flex justify-between items-center">
        <div class="flex space-x-2">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                <i class="fas fa-filter mr-2"></i>All Payments
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                Completed
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                Pending
            </button>
        </div>
        <input type="text" placeholder="Search transactions..." class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
</div>

<!-- Payments Table -->
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Transaction ID</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Service Request</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Payment Method</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="font-semibold text-gray-800">#TXN-00001</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="text-gray-800">Request #00001</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="font-bold text-gray-800">$150.00</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <i class="fas fa-credit-card text-gray-600 mr-2"></i>
                        <span class="text-gray-800">Credit Card</span>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                        <i class="fas fa-check mr-1"></i>Completed
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                    {{ now()->format('M d, Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right">
                    <button class="text-blue-600 hover:text-blue-800 mr-3">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-download"></i>
                    </button>
                </td>
            </tr>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="font-semibold text-gray-800">#TXN-00002</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="text-gray-800">Request #00002</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="font-bold text-gray-800">$300.00</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <i class="fab fa-paypal text-gray-600 mr-2"></i>
                        <span class="text-gray-800">PayPal</span>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock mr-1"></i>Pending
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                    {{ now()->format('M d, Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right">
                    <button class="text-blue-600 hover:text-blue-800 mr-3">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="text-green-600 hover:text-green-800">
                        <i class="fas fa-redo"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="mt-6 text-center text-gray-500">
    <p>Sample payment records shown. Your actual transactions will appear here.</p>
</div>
@endsection

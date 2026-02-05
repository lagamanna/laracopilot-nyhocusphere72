@extends('layouts.app')

@section('title', 'New Service Request')

@section('content')
<div class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-4xl font-bold">New Service Request</h1>
        <p class="text-indigo-100 mt-2">Submit a new service request with document uploads</p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-8">
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('service-requests.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Service Type <span class="text-red-500">*</span></label>
                <select name="service_type_id" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="">Select Service Type</option>
                    @foreach($serviceTypes as $type)
                        <option value="{{ $type->id }}" {{ old('service_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }} - ${{ number_format($type->price, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Priority Level <span class="text-red-500">*</span></label>
                <select name="priority" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority', 'medium') === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Request Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Describe your service request in detail..." required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Additional Notes</label>
                <textarea name="notes" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Any additional information...">{{ old('notes') }}</textarea>
            </div>

            <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-6 mb-6">
                <h3 class="font-bold text-indigo-900 mb-4 text-lg">Document Uploads</h3>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Aadhaar Card</label>
                    <input type="file" name="aadhaar" accept=".pdf,.jpg,.jpeg,.png" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <p class="text-sm text-gray-500 mt-1">Accepted formats: PDF, JPG, PNG (Max 5MB)</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">PAN Card</label>
                    <input type="file" name="pan" accept=".pdf,.jpg,.jpeg,.png" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <p class="text-sm text-gray-500 mt-1">Accepted formats: PDF, JPG, PNG (Max 5MB)</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Address Proof</label>
                    <input type="file" name="address_proof" accept=".pdf,.jpg,.jpeg,.png" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <p class="text-sm text-gray-500 mt-1">Accepted formats: PDF, JPG, PNG (Max 5MB)</p>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Other Documents</label>
                    <input type="file" name="other_documents[]" multiple accept=".pdf,.jpg,.jpeg,.png" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <p class="text-sm text-gray-500 mt-1">Upload multiple files if needed</p>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('service-requests.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition">
                    Cancel
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg font-semibold transition">
                    <i class="fas fa-paper-plane mr-2"></i>Submit Request
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

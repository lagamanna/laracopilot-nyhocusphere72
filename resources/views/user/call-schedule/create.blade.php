@extends('layouts.app')

@section('title', 'Schedule Call')

@section('content')
<div class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-4xl font-bold">Schedule a Call</h1>
        <p class="text-indigo-100 mt-2">Book a consultation with our back-office team</p>
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

        <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-6 mb-8">
            <h3 class="font-bold text-indigo-900 mb-2 text-lg"><i class="fas fa-info-circle mr-2"></i>Call Scheduling Information</h3>
            <ul class="text-indigo-800 text-sm space-y-1">
                <li>• Our team will call you at your scheduled time</li>
                <li>• Please ensure your phone is available</li>
                <li>• Consultation typically lasts 15-30 minutes</li>
                <li>• You can reschedule up to 2 hours before the call</li>
            </ul>
        </div>

        <form action="{{ route('call-schedule.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Related Service Request (Optional)</label>
                <select name="service_request_id" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Not related to any request</option>
                    @foreach($serviceRequests as $request)
                        <option value="{{ $request->id }}" {{ old('service_request_id') == $request->id ? 'selected' : '' }}>
                            #{{ str_pad($request->id, 5, '0', STR_PAD_LEFT) }} - {{ $request->serviceType->name ?? 'N/A' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Preferred Date <span class="text-red-500">*</span></label>
                <input type="date" name="scheduled_date" value="{{ old('scheduled_date') }}" min="{{ date('Y-m-d') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Preferred Time <span class="text-red-500">*</span></label>
                <select name="scheduled_time" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="">Select time slot</option>
                    <option value="09:00" {{ old('scheduled_time') === '09:00' ? 'selected' : '' }}>9:00 AM - 9:30 AM</option>
                    <option value="09:30" {{ old('scheduled_time') === '09:30' ? 'selected' : '' }}>9:30 AM - 10:00 AM</option>
                    <option value="10:00" {{ old('scheduled_time') === '10:00' ? 'selected' : '' }}>10:00 AM - 10:30 AM</option>
                    <option value="10:30" {{ old('scheduled_time') === '10:30' ? 'selected' : '' }}>10:30 AM - 11:00 AM</option>
                    <option value="11:00" {{ old('scheduled_time') === '11:00' ? 'selected' : '' }}>11:00 AM - 11:30 AM</option>
                    <option value="11:30" {{ old('scheduled_time') === '11:30' ? 'selected' : '' }}>11:30 AM - 12:00 PM</option>
                    <option value="14:00" {{ old('scheduled_time') === '14:00' ? 'selected' : '' }}>2:00 PM - 2:30 PM</option>
                    <option value="14:30" {{ old('scheduled_time') === '14:30' ? 'selected' : '' }}>2:30 PM - 3:00 PM</option>
                    <option value="15:00" {{ old('scheduled_time') === '15:00' ? 'selected' : '' }}>3:00 PM - 3:30 PM</option>
                    <option value="15:30" {{ old('scheduled_time') === '15:30' ? 'selected' : '' }}>3:30 PM - 4:00 PM</option>
                    <option value="16:00" {{ old('scheduled_time') === '16:00' ? 'selected' : '' }}>4:00 PM - 4:30 PM</option>
                    <option value="16:30" {{ old('scheduled_time') === '16:30' ? 'selected' : '' }}>4:30 PM - 5:00 PM</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Contact Number <span class="text-red-500">*</span></label>
                <input type="text" name="contact_number" value="{{ old('contact_number', session('user_phone')) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Call Purpose <span class="text-red-500">*</span></label>
                <textarea name="purpose" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Please describe what you'd like to discuss during the call..." required>{{ old('purpose') }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Additional Notes</label>
                <textarea name="notes" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Any additional information or special requests...">{{ old('notes') }}</textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition">
                    Cancel
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg font-semibold transition">
                    <i class="fas fa-calendar-check mr-2"></i>Schedule Call
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

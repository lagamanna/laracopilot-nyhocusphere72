@extends('layouts.user')

@section('title', 'New Service Request')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Submit New Request</h1>
    <p class="text-gray-600 mt-2">Fill out the form below to submit a new service request</p>
</div>

@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-lg shadow-lg p-8">
    <form action="{{ route('user.requests.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Service Type Selection -->
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-3">
                <i class="fas fa-list-alt mr-2"></i>Service Type *
            </label>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @if(isset($serviceTypes) && count($serviceTypes) > 0)
                    @foreach($serviceTypes as $serviceType)
                    <label class="border-2 border-gray-200 rounded-lg p-4 cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition">
                        <input type="radio" name="service_type_id" value="{{ $serviceType->id }}" class="mr-3" {{ old('service_type_id') == $serviceType->id ? 'checked' : '' }} required>
                        <div class="inline-block">
                            <div class="font-semibold text-gray-800">{{ $serviceType->name }}</div>
                            <div class="text-sm text-gray-600">${{ number_format($serviceType->base_price, 2) }}</div>
                        </div>
                    </label>
                    @endforeach
                @else
                    <label class="border-2 border-gray-200 rounded-lg p-4 cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition">
                        <input type="radio" name="service_type_id" value="1" class="mr-3" required>
                        <div class="inline-block">
                            <div class="font-semibold text-gray-800">Document Verification</div>
                            <div class="text-sm text-gray-600">$150.00</div>
                        </div>
                    </label>
                    
                    <label class="border-2 border-gray-200 rounded-lg p-4 cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition">
                        <input type="radio" name="service_type_id" value="2" class="mr-3">
                        <div class="inline-block">
                            <div class="font-semibold text-gray-800">Legal Document Drafting</div>
                            <div class="text-sm text-gray-600">$300.00</div>
                        </div>
                    </label>
                    
                    <label class="border-2 border-gray-200 rounded-lg p-4 cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition">
                        <input type="radio" name="service_type_id" value="3" class="mr-3">
                        <div class="inline-block">
                            <div class="font-semibold text-gray-800">Legal Consultation</div>
                            <div class="text-sm text-gray-600">$200.00/hr</div>
                        </div>
                    </label>
                @endif
            </div>
            @error('service_type_id')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Request Title -->
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">
                <i class="fas fa-heading mr-2"></i>Request Title *
            </label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror" placeholder="Brief title for your request" required>
            @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Description -->
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">
                <i class="fas fa-align-left mr-2"></i>Description *
            </label>
            <textarea name="description" rows="5" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror" placeholder="Provide detailed description of your service request" required>{{ old('description') }}</textarea>
            @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Priority Level -->
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">
                <i class="fas fa-flag mr-2"></i>Priority Level *
            </label>
            <select name="priority" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('priority') border-red-500 @enderror" required>
                <option value="">Select Priority</option>
                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low - Standard Processing</option>
                <option value="normal" {{ old('priority') == 'normal' ? 'selected' : 'selected' }}>Normal - Regular Processing</option>
                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High - Expedited Processing (+$50)</option>
                <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent - Rush Processing (+$100)</option>
            </select>
            @error('priority')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Preferred Contact Method -->
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">
                <i class="fas fa-phone mr-2"></i>Preferred Contact Method *
            </label>
            <div class="flex space-x-4">
                <label class="flex items-center">
                    <input type="radio" name="contact_method" value="email" class="mr-2" {{ old('contact_method', 'email') == 'email' ? 'checked' : '' }} required>
                    <span>Email</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="contact_method" value="phone" class="mr-2" {{ old('contact_method') == 'phone' ? 'checked' : '' }}>
                    <span>Phone</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="contact_method" value="both" class="mr-2" {{ old('contact_method') == 'both' ? 'checked' : '' }}>
                    <span>Both</span>
                </label>
            </div>
            @error('contact_method')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Additional Notes -->
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">
                <i class="fas fa-sticky-note mr-2"></i>Additional Notes
            </label>
            <textarea name="notes" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Any additional information or special requirements">{{ old('notes') }}</textarea>
        </div>

        <!-- Document Upload -->
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">
                <i class="fas fa-upload mr-2"></i>Upload Supporting Documents (Optional)
            </label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-500 transition">
                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                <p class="text-gray-600 mb-2">Click to browse and select files</p>
                <input type="file" name="documents[]" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="w-full" id="fileInput">
                <p class="text-xs text-gray-500 mt-2">Accepted formats: PDF, DOC, DOCX, JPG, PNG (Max 10MB per file)</p>
                <div id="fileList" class="mt-4 text-left"></div>
            </div>
            @error('documents.*')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Terms and Conditions -->
        <div class="mb-6">
            <label class="flex items-start">
                <input type="checkbox" name="terms" class="mt-1 mr-3" required>
                <span class="text-gray-700">
                    I agree to the <a href="#" class="text-blue-600 hover:underline">Terms and Conditions</a> and 
                    <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>. I understand that fees may apply.
                </span>
            </label>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('user.requests.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg transition">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                <i class="fas fa-paper-plane mr-2"></i>Submit Request
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('fileInput').addEventListener('change', function(e) {
    const fileList = document.getElementById('fileList');
    fileList.innerHTML = '';
    
    if (this.files.length > 0) {
        fileList.innerHTML = '<p class="font-semibold text-gray-700 mb-2">Selected Files:</p>';
        Array.from(this.files).forEach(file => {
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            fileList.innerHTML += `
                <div class="flex items-center justify-between bg-gray-50 p-2 rounded mb-2">
                    <span class="text-sm text-gray-700"><i class="fas fa-file mr-2"></i>${file.name}</span>
                    <span class="text-xs text-gray-500">${fileSize} MB</span>
                </div>
            `;
        });
    }
});
</script>
@endsection

@extends('layouts.app')

@section('title', 'Draft Details')

@section('content')
<div class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-4xl font-bold">{{ $draft->title }}</h1>
        <p class="text-indigo-100 mt-2">Review draft and provide feedback</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Draft Details -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $draft->title }}</h2>
                        <p class="text-gray-600 mt-1">Version {{ $draft->version }} • Uploaded {{ $draft->created_at->format('M d, Y') }}</p>
                    </div>
                    <span class="px-4 py-2 rounded-full text-sm font-semibold
                        @if($draft->status === 'approved') bg-green-100 text-green-800
                        @elseif($draft->status === 'rejected') bg-red-100 text-red-800
                        @elseif($draft->status === 'revision') bg-yellow-100 text-yellow-800
                        @else bg-blue-100 text-blue-800 @endif">
                        {{ ucfirst($draft->status) }}
                    </span>
                </div>

                <div class="border-t pt-6">
                    <h3 class="font-bold text-gray-800 mb-3">Description</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $draft->description }}</p>
                </div>

                <div class="border-t pt-6 mt-6">
                    <h3 class="font-bold text-gray-800 mb-3">Draft Document</h3>
                    <div class="bg-gray-50 border rounded-lg p-6 text-center">
                        <i class="fas fa-file-pdf text-6xl text-red-500 mb-4"></i>
                        <p class="font-semibold text-gray-800 mb-2">{{ $draft->file_name }}</p>
                        <a href="{{ route('drafts.download', $draft->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold inline-block transition">
                            <i class="fas fa-download mr-2"></i>Download Draft
                        </a>
                    </div>
                </div>
            </div>

            <!-- Feedback Form -->
            @if(!$draft->feedback)
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="font-bold text-gray-800 mb-4 text-xl">Submit Feedback</h3>
                <form action="{{ route('drafts.feedback', $draft->id) }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3">Satisfaction Rating</label>
                        <div class="flex items-center space-x-2">
                            @for($i = 1; $i <= 5; $i++)
                            <label class="cursor-pointer">
                                <input type="radio" name="satisfaction_rating" value="{{ $i }}" class="hidden peer" {{ $i === 5 ? 'checked' : '' }}>
                                <i class="fas fa-star text-3xl text-gray-300 peer-checked:text-yellow-500 hover:text-yellow-400 transition"></i>
                            </label>
                            @endfor
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Feedback Comments</label>
                        <textarea name="feedback_text" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Share your thoughts on this draft..."></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="needs_revision" value="1" class="mr-2">
                            <span class="text-gray-700 font-semibold">Request Revision</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-paper-plane mr-2"></i>Submit Feedback
                    </button>
                </form>
            </div>
            @else
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="font-bold text-gray-800 mb-4 text-xl">Your Feedback</h3>
                <div class="mb-4">
                    <p class="text-gray-600 font-semibold mb-2">Rating:</p>
                    <div class="flex items-center">
                        <span class="text-yellow-500 text-2xl">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $draft->feedback->satisfaction_rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </span>
                        <span class="ml-3 text-gray-700 font-bold">{{ $draft->feedback->satisfaction_rating }}/5</span>
                    </div>
                </div>
                <div class="mb-4">
                    <p class="text-gray-600 font-semibold mb-2">Comments:</p>
                    <p class="text-gray-700">{{ $draft->feedback->feedback_text ?? 'No comments provided' }}</p>
                </div>
                @if($draft->feedback->needs_revision)
                <div class="bg-yellow-50 border border-yellow-200 rounded p-3">
                    <p class="text-yellow-800 font-semibold"><i class="fas fa-exclamation-triangle mr-2"></i>Revision Requested</p>
                </div>
                @endif
            </div>
            @endif

            <!-- Chat Section -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="font-bold text-gray-800 mb-4 text-xl">Draft Discussion</h3>
                <div class="space-y-4 mb-6 max-h-96 overflow-y-auto">
                    @forelse($draft->chats as $chat)
                    <div class="flex {{ $chat->sender_type === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-md {{ $chat->sender_type === 'user' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-800' }} rounded-lg px-4 py-3">
                            <p class="text-sm font-semibold mb-1">{{ $chat->sender_type === 'user' ? 'You' : 'Admin' }}</p>
                            <p>{{ $chat->message }}</p>
                            <p class="text-xs mt-1 opacity-75">{{ $chat->created_at->format('M d, h:i A') }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-center py-6">No messages yet. Start the conversation!</p>
                    @endforelse
                </div>

                <form action="{{ route('drafts.chat', $draft->id) }}" method="POST" class="flex space-x-2">
                    @csrf
                    <input type="text" name="message" placeholder="Type your message..." class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h3 class="font-bold text-gray-800 mb-4">Draft Information</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-500">Service Request</p>
                        <p class="font-semibold text-gray-800">#{{ str_pad($draft->service_request_id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Version</p>
                        <p class="font-semibold text-gray-800">{{ $draft->version }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Uploaded</p>
                        <p class="font-semibold text-gray-800">{{ $draft->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-6">
                <h3 class="font-bold text-indigo-900 mb-4">Actions</h3>
                <div class="space-y-2">
                    <a href="{{ route('drafts.download', $draft->id) }}" class="block w-full bg-green-600 hover:bg-green-700 text-white text-center px-4 py-2 rounded transition">
                        <i class="fas fa-download mr-2"></i>Download
                    </a>
                    <a href="{{ route('drafts.index') }}" class="block w-full bg-gray-300 hover:bg-gray-400 text-gray-800 text-center px-4 py-2 rounded transition">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Drafts
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

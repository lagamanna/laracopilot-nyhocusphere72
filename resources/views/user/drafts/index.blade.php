@extends('layouts.app')

@section('title', 'My Drafts')

@section('content')
<div class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-4xl font-bold">My Drafts</h1>
        <p class="text-indigo-100 mt-2">Review and provide feedback on uploaded drafts</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($drafts as $draft)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-bold text-lg text-gray-800">{{ $draft->title }}</h3>
                        <p class="text-sm text-gray-500">Request #{{ str_pad($draft->service_request_id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        @if($draft->status === 'approved') bg-green-100 text-green-800
                        @elseif($draft->status === 'rejected') bg-red-100 text-red-800
                        @elseif($draft->status === 'revision') bg-yellow-100 text-yellow-800
                        @else bg-blue-100 text-blue-800 @endif">
                        {{ ucfirst($draft->status) }}
                    </span>
                </div>

                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($draft->description, 100) }}</p>

                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                    <span><i class="fas fa-file mr-1"></i>{{ $draft->version }}</span>
                    <span><i class="fas fa-calendar mr-1"></i>{{ $draft->created_at->format('M d, Y') }}</span>
                </div>

                @if($draft->feedback)
                <div class="mb-4 p-3 bg-purple-50 border border-purple-200 rounded">
                    <p class="text-xs text-purple-800 font-semibold mb-1">Your Feedback:</p>
                    <div class="flex items-center">
                        <span class="text-yellow-500">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $draft->feedback->satisfaction_rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </span>
                        <span class="ml-2 text-sm text-gray-700">{{ $draft->feedback->satisfaction_rating }}/5</span>
                    </div>
                </div>
                @endif

                <div class="flex space-x-2">
                    <a href="{{ route('drafts.show', $draft->id) }}" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white text-center px-4 py-2 rounded transition text-sm font-semibold">
                        <i class="fas fa-eye mr-1"></i>View
                    </a>
                    <a href="{{ route('drafts.download', $draft->id) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition text-sm">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <i class="fas fa-file-alt text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">No drafts available</p>
            <p class="text-gray-400 text-sm mt-2">Drafts will appear here once uploaded by admin</p>
        </div>
        @endforelse
    </div>

    @if($drafts->hasPages())
    <div class="mt-8">
        {{ $drafts->links() }}
    </div>
    @endif
</div>
@endsection

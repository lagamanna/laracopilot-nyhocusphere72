@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-50 py-12 px-4">
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-lg shadow-xl p-8">
            <div class="text-center mb-8">
                <i class="fas fa-user-plus text-5xl text-indigo-600 mb-4"></i>
                <h2 class="text-3xl font-bold text-gray-800">Create Account</h2>
                <p class="text-gray-600 mt-2">Join our service request platform</p>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">6-Digit PIN</label>
                    <input type="password" name="pin" maxlength="6" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <p class="text-sm text-gray-500 mt-1">Create a 6-digit PIN for secure login</p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Address</label>
                    <textarea name="address" rows="3" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>{{ old('address') }}</textarea>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-3 rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-800 transition transform hover:scale-105">
                    Register Now
                </button>
            </form>

            <div class="text-center mt-6">
                <p class="text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-semibold">Login here</a></p>
            </div>
        </div>
    </div>
</div>
@endsection

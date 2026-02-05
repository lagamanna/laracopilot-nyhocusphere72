@extends('layouts.user')

@section('title', 'My Profile')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">My Profile</h1>
    <p class="text-gray-600 mt-2">Manage your account information and preferences</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Profile Card -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-center mb-6">
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 w-32 h-32 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user text-white text-5xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">{{ session('user_name', 'User Name') }}</h2>
                <p class="text-gray-600">{{ session('user_email', 'user@example.com') }}</p>
                <span class="inline-block mt-3 px-4 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                    <i class="fas fa-check-circle mr-1"></i>Active Member
                </span>
            </div>
            
            <div class="space-y-3 mb-6">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">Member Since</span>
                    <span class="font-semibold text-gray-800">{{ now()->format('M Y') }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">Total Requests</span>
                    <span class="font-semibold text-gray-800">0</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">Documents</span>
                    <span class="font-semibold text-gray-800">0</span>
                </div>
            </div>
            
            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition">
                <i class="fas fa-camera mr-2"></i>Change Photo
            </button>
        </div>
    </div>

    <!-- Profile Forms -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Personal Information -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">
                <i class="fas fa-user-edit mr-2 text-blue-600"></i>Personal Information
            </h3>
            <form action="#" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ session('user_name', '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ session('user_email', '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Phone Number</label>
                        <input type="tel" name="phone" value="+1 (555) 123-4567" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Date of Birth</label>
                        <input type="date" name="dob" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-semibold mb-2">Address</label>
                        <textarea name="address" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your complete address"></textarea>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Change Password -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">
                <i class="fas fa-lock mr-2 text-blue-600"></i>Change Password
            </h3>
            <form action="#" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Current Password</label>
                        <input type="password" name="current_password" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">New Password</label>
                        <input type="password" name="new_password" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                        <i class="fas fa-key mr-2"></i>Update Password
                    </button>
                </div>
            </form>
        </div>

        <!-- Notification Preferences -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">
                <i class="fas fa-bell mr-2 text-blue-600"></i>Notification Preferences
            </h3>
            <form action="#" method="POST">
                @csrf
                <div class="space-y-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="email_notifications" checked class="mr-3 w-5 h-5">
                        <div>
                            <span class="font-semibold text-gray-800">Email Notifications</span>
                            <p class="text-sm text-gray-600">Receive updates about your requests via email</p>
                        </div>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="sms_notifications" class="mr-3 w-5 h-5">
                        <div>
                            <span class="font-semibold text-gray-800">SMS Notifications</span>
                            <p class="text-sm text-gray-600">Get text message alerts for important updates</p>
                        </div>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="marketing_emails" class="mr-3 w-5 h-5">
                        <div>
                            <span class="font-semibold text-gray-800">Marketing Emails</span>
                            <p class="text-sm text-gray-600">Receive promotional offers and updates</p>
                        </div>
                    </label>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>Save Preferences
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Service Request System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-indigo-600 to-purple-700 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <div class="bg-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800">Admin Login</h1>
                <p class="text-gray-600 mt-2">Service Request Management System</p>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Test Credentials Display -->
            <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4 mb-6">
                <p class="font-bold text-indigo-900 mb-2 text-sm"><i class="fas fa-info-circle mr-1"></i>Test Credentials:</p>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">Admin:</span>
                        <span class="font-mono text-indigo-700">admin@servicerequest.com / admin123</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">Manager:</span>
                        <span class="font-mono text-indigo-700">manager@servicerequest.com / manager123</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">Verifier:</span>
                        <span class="font-mono text-indigo-700">verifier@servicerequest.com / verifier123</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email Address
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Enter your email" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 text-white py-3 rounded-lg font-bold transition transform hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login to Admin Panel
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="/" class="text-indigo-600 hover:underline text-sm">
                    <i class="fas fa-arrow-left mr-1"></i>Back to Home
                </a>
            </div>
        </div>

        <div class="text-center mt-6 text-white">
            <p class="text-sm">© {{ date('Y') }} Service Request System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

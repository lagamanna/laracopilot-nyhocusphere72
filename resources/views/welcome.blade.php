<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Request & Document Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-3 rounded-lg mr-3">
                        <i class="fas fa-briefcase text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Service Portal</h1>
                        <p class="text-sm text-gray-600">Professional Document Management</p>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('user.login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                    <a href="{{ route('user.register') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                        <i class="fas fa-user-plus mr-2"></i>Register
                    </a>
                    <a href="{{ route('admin.login') }}" class="bg-gray-700 hover:bg-gray-800 text-white px-6 py-2 rounded-lg transition">
                        <i class="fas fa-user-shield mr-2"></i>Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-5xl font-bold mb-6">Professional Service Request Management</h2>
            <p class="text-xl text-blue-100 mb-8">Streamline your document verification, legal drafting, and consultation services with our comprehensive platform</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('user.register') }}" class="bg-white hover:bg-gray-100 text-blue-600 font-bold px-8 py-4 rounded-lg transition transform hover:scale-105">
                    <i class="fas fa-rocket mr-2"></i>Get Started Free
                </a>
                <a href="#features" class="bg-blue-700 hover:bg-blue-600 text-white font-bold px-8 py-4 rounded-lg transition">
                    <i class="fas fa-info-circle mr-2"></i>Learn More
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Powerful Features for Your Business</h2>
                <p class="text-xl text-gray-600">Everything you need to manage service requests efficiently</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-xl hover:shadow-xl transition">
                    <div class="bg-blue-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-file-alt text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Service Request Management</h3>
                    <p class="text-gray-600">Submit and track service requests for document verification, legal drafting, and consultation services with real-time status updates.</p>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-xl hover:shadow-xl transition">
                    <div class="bg-green-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Secure Document Storage</h3>
                    <p class="text-gray-600">Upload, store, and manage your documents securely with verification status tracking and easy access anytime, anywhere.</p>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-xl hover:shadow-xl transition">
                    <div class="bg-purple-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-calendar-check text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Call Scheduling</h3>
                    <p class="text-gray-600">Schedule consultation calls with professionals, manage appointments, and receive reminders for upcoming meetings.</p>
                </div>

                <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-8 rounded-xl hover:shadow-xl transition">
                    <div class="bg-orange-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-credit-card text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Payment Processing</h3>
                    <p class="text-gray-600">Secure payment tracking and management with multiple payment methods supported and transparent transaction history.</p>
                </div>

                <div class="bg-gradient-to-br from-red-50 to-red-100 p-8 rounded-xl hover:shadow-xl transition">
                    <div class="bg-red-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-file-contract text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Draft Management</h3>
                    <p class="text-gray-600">Collaborate on document drafts with real-time feedback, version control, and approval workflow management.</p>
                </div>

                <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 p-8 rounded-xl hover:shadow-xl transition">
                    <div class="bg-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Analytics & Reporting</h3>
                    <p class="text-gray-600">Comprehensive dashboards with KPIs, request statistics, and performance metrics to track your business growth.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Our Services</h2>
                <p class="text-xl text-gray-600">Professional services tailored to your needs</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition">
                    <div class="text-center mb-6">
                        <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-check-double text-blue-600 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Document Verification</h3>
                        <p class="text-3xl font-bold text-blue-600 mt-4">$150.00</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Identity Document Verification
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Educational Certificate Verification
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Professional License Verification
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            3-5 Business Days Turnaround
                        </li>
                    </ul>
                    <a href="{{ route('user.register') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg font-bold transition">
                        Get Started
                    </a>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition border-2 border-blue-600">
                    <div class="text-center mb-6">
                        <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-bold">Most Popular</span>
                        <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto my-4">
                            <i class="fas fa-pen-fancy text-blue-600 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Legal Document Drafting</h3>
                        <p class="text-3xl font-bold text-blue-600 mt-4">$300.00</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Contract Agreements
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Business Partnership Documents
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Legal Notices & Letters
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            5-7 Business Days Turnaround
                        </li>
                    </ul>
                    <a href="{{ route('user.register') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg font-bold transition">
                        Get Started
                    </a>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition">
                    <div class="text-center mb-6">
                        <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-comments text-blue-600 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Legal Consultation</h3>
                        <p class="text-3xl font-bold text-blue-600 mt-4">$200.00<span class="text-lg text-gray-600">/hr</span></p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            One-on-One Consultation
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Legal Advice & Guidance
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Video or Phone Call Options
                        </li>
                        <li class="flex items-center text-gray-700">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            Flexible Scheduling
                        </li>
                    </ul>
                    <a href="{{ route('user.register') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg font-bold transition">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">What Our Clients Say</h2>
                <p class="text-xl text-gray-600">Trusted by businesses and professionals worldwide</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl shadow-lg">
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-700 mb-6 italic">"The document verification service was incredibly fast and reliable. Saved us weeks of manual processing time!"</p>
                    <div class="flex items-center">
                        <div class="bg-blue-600 w-12 h-12 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold">JD</span>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">John Davis</p>
                            <p class="text-sm text-gray-600">CEO, Tech Solutions Inc.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl shadow-lg">
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-700 mb-6 italic">"Professional legal drafting services with excellent attention to detail. Highly recommended for any business needs."</p>
                    <div class="flex items-center">
                        <div class="bg-green-600 w-12 h-12 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold">SM</span>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">Sarah Martinez</p>
                            <p class="text-sm text-gray-600">Managing Partner, Martinez & Associates</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl shadow-lg">
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-700 mb-6 italic">"The platform is intuitive and makes managing service requests effortless. Great customer support team as well!"</p>
                    <div class="flex items-center">
                        <div class="bg-purple-600 w-12 h-12 rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-bold">RK</span>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">Robert Kim</p>
                            <p class="text-sm text-gray-600">Operations Director, Global Enterprises</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6">Ready to Get Started?</h2>
            <p class="text-xl text-blue-100 mb-8">Join thousands of satisfied clients managing their service requests efficiently</p>
            <a href="{{ route('user.register') }}" class="inline-block bg-white hover:bg-gray-100 text-blue-600 font-bold px-12 py-4 rounded-lg transition transform hover:scale-105">
                <i class="fas fa-user-plus mr-2"></i>Create Free Account
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">Service Portal</h3>
                <p class="text-gray-400">Professional document management and service request platform for businesses and individuals.</p>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="#features" class="text-gray-400 hover:text-white transition">Features</a></li>
                    <li><a href="#services" class="text-gray-400 hover:text-white transition">Services</a></li>
                    <li><a href="{{ route('user.login') }}" class="text-gray-400 hover:text-white transition">Login</a></li>
                    <li><a href="{{ route('user.register') }}" class="text-gray-400 hover:text-white transition">Register</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">Services</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Document Verification</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Legal Drafting</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Consultation</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Custom Services</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">Contact</h3>
                <ul class="space-y-2">
                    <li class="flex items-center text-gray-400">
                        <i class="fas fa-envelope mr-3"></i>
                        <span>support@serviceportal.com</span>
                    </li>
                    <li class="flex items-center text-gray-400">
                        <i class="fas fa-phone mr-3"></i>
                        <span>+1 (555) 123-4567</span>
                    </li>
                    <li class="flex items-center text-gray-400">
                        <i class="fas fa-map-marker-alt mr-3"></i>
                        <span>123 Business St, City, ST 12345</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 py-6 text-center text-sm">
            <p>© {{ date('Y') }} Service Portal. All rights reserved.</p>
            <p class="mt-2">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="hover:underline">LaraCopilot</a></p>
        </div>
    </footer>
</body>
</html>

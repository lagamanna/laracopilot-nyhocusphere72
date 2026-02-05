<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }
    
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'pin' => 'required|string|size:6',
            'address' => 'required|string|max:500'
        ]);
        
        $verificationToken = Str::random(32);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['pin']), // Use PIN as password for Laravel's default users table
            'phone' => $validated['phone'],
            'pin' => Hash::make($validated['pin']),
            'address' => $validated['address'],
            'email_verification_token' => $verificationToken,
            'email_verified_at' => null
        ]);
        
        // Send verification email (simulated)
        $verificationUrl = route('email.verify', ['token' => $verificationToken]);
        
        return redirect()->route('login')->with('success', "Registration successful! Please verify your email. Verification link: {$verificationUrl}");
    }
}
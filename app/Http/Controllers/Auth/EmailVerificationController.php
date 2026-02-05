<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verify($token)
    {
        $user = User::where('email_verification_token', $token)->first();
        
        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Invalid verification token']);
        }
        
        $user->update([
            'email_verified_at' => now(),
            'email_verification_token' => null
        ]);
        
        return redirect()->route('login')->with('success', 'Email verified successfully! You can now login.');
    }
}
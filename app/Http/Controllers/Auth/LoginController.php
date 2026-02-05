<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'pin' => 'required|string'
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user || !Hash::check($request->pin, $user->pin)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
        
        if (!$user->email_verified_at) {
            return back()->withErrors(['email' => 'Please verify your email before logging in']);
        }
        
        session([
            'user_logged_in' => true,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email
        ]);
        
        return redirect()->route('dashboard');
    }
    
    public function logout()
    {
        session()->forget(['user_logged_in', 'user_id', 'user_name', 'user_email']);
        return redirect()->route('login');
    }
}
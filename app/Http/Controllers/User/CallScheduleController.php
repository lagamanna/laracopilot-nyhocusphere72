<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CallSchedule;
use Illuminate\Http\Request;

class CallScheduleController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }
        
        $schedules = CallSchedule::where('user_id', session('user_id'))
            ->orderBy('scheduled_at', 'desc')
            ->paginate(10);
        
        return view('user.call-schedule.index', compact('schedules'));
    }
    
    public function create()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }
        
        return view('user.call-schedule.create');
    }
    
    public function store(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }
        
        $validated = $request->validate([
            'preferred_date' => 'required|date|after:today',
            'preferred_time' => 'required|string',
            'topic' => 'required|string|max:255',
            'notes' => 'nullable|string|max:500'
        ]);
        
        CallSchedule::create([
            'user_id' => session('user_id'),
            'scheduled_at' => $validated['preferred_date'] . ' ' . $validated['preferred_time'],
            'topic' => $validated['topic'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending'
        ]);
        
        return redirect()->route('dashboard')
            ->with('success', 'Call scheduled successfully! Our team will contact you at the scheduled time.');
    }
}
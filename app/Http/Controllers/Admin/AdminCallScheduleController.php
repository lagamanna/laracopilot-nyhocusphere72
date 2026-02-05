<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CallSchedule;
use Illuminate\Http\Request;

class AdminCallScheduleController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $schedules = CallSchedule::with('user')
            ->orderBy('scheduled_at', 'asc')
            ->paginate(15);
        
        return view('admin.call-schedules.index', compact('schedules'));
    }
    
    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
            'notes' => 'nullable|string|max:500'
        ]);
        
        $schedule = CallSchedule::findOrFail($id);
        $schedule->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['notes'] ?? $schedule->admin_notes
        ]);
        
        return back()->with('success', 'Call schedule updated!');
    }
}
<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\Document;
use App\Models\CallSchedule;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $userId = session('user_id');
        
        // KPI Calculations
        $totalRequests = ServiceRequest::where('user_id', $userId)->count();
        $pendingRequests = ServiceRequest::where('user_id', $userId)->where('status', 'pending')->count();
        $completedRequests = ServiceRequest::where('user_id', $userId)->where('status', 'completed')->count();
        $totalDocuments = Document::where('user_id', $userId)->count();
        
        // Recent Service Requests
        $recentRequests = ServiceRequest::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Upcoming Scheduled Calls
        $upcomingCalls = CallSchedule::where('user_id', $userId)
            ->where('scheduled_date', '>=', now()->toDateString())
            ->orderBy('scheduled_date', 'asc')
            ->orderBy('scheduled_time', 'asc')
            ->limit(3)
            ->get();
        
        return view('user.dashboard', compact(
            'totalRequests',
            'pendingRequests',
            'completedRequests',
            'totalDocuments',
            'recentRequests',
            'upcomingCalls'
        ));
    }
}
<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\Document;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $userId = session('user_id');
        
        // Get statistics
        $totalRequests = ServiceRequest::where('user_id', $userId)->count();
        $pendingRequests = ServiceRequest::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();
        $approvedRequests = ServiceRequest::where('user_id', $userId)
            ->where('status', 'approved')
            ->count();
        $completedRequests = ServiceRequest::where('user_id', $userId)
            ->where('status', 'completed')
            ->count();
        $rejectedRequests = ServiceRequest::where('user_id', $userId)
            ->where('status', 'rejected')
            ->count();
        
        // Get recent requests
        $recentRequests = ServiceRequest::where('user_id', $userId)
            ->with('serviceType')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('user.dashboard', compact(
            'totalRequests',
            'pendingRequests',
            'approvedRequests',
            'completedRequests',
            'rejectedRequests',
            'recentRequests'
        ));
    }
}
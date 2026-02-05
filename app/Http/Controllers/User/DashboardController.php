<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\Draft;
use App\Models\Payment;
use App\Models\Feedback;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }
        
        $userId = session('user_id');
        
        $totalRequests = ServiceRequest::where('user_id', $userId)->count();
        $pendingRequests = ServiceRequest::where('user_id', $userId)->where('status', 'pending')->count();
        $approvedRequests = ServiceRequest::where('user_id', $userId)->where('status', 'approved')->count();
        $completedRequests = ServiceRequest::where('user_id', $userId)->where('status', 'completed')->count();
        
        $draftsPending = Draft::whereHas('serviceRequest', function($q) use ($userId) {
            $q->where('user_id', $userId);
        })->where('status', 'pending_review')->count();
        
        $totalPayments = Payment::whereHas('serviceRequest', function($q) use ($userId) {
            $q->where('user_id', $userId);
        })->where('payment_status', 'completed')->sum('amount');
        
        $recentRequests = ServiceRequest::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('user.dashboard', compact(
            'totalRequests', 'pendingRequests', 'approvedRequests', 'completedRequests',
            'draftsPending', 'totalPayments', 'recentRequests'
        ));
    }
}
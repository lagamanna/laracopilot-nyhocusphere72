<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\Document;
use App\Models\CallSchedule;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        // KPI Calculations
        $totalRequests = ServiceRequest::count();
        $pendingRequests = ServiceRequest::where('status', 'pending')->count();
        $completedRequests = ServiceRequest::where('status', 'completed')->count();
        $totalRevenue = Payment::where('payment_status', 'completed')->sum('amount');
        
        // Recent Service Requests
        $recentRequests = ServiceRequest::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Pending Documents for Verification
        $pendingDocuments = Document::where('verification_status', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Upcoming Scheduled Calls
        $upcomingCalls = CallSchedule::with('user')
            ->where('scheduled_date', '>=', now()->toDateString())
            ->orderBy('scheduled_date', 'asc')
            ->orderBy('scheduled_time', 'asc')
            ->limit(5)
            ->get();
        
        // Recent Payments
        $recentPayments = Payment::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalRequests',
            'pendingRequests',
            'completedRequests',
            'totalRevenue',
            'recentRequests',
            'pendingDocuments',
            'upcomingCalls',
            'recentPayments'
        ));
    }
}
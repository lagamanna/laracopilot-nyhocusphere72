<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\Document;
use App\Models\Draft;
use App\Models\Payment;
use App\Models\CallSchedule;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $totalRequests = ServiceRequest::count();
        $pendingRequests = ServiceRequest::where('status', 'pending')->count();
        $approvedRequests = ServiceRequest::where('status', 'approved')->count();
        $completedRequests = ServiceRequest::where('status', 'completed')->count();
        
        $pendingDocuments = Document::where('verification_status', 'pending')->count();
        $pendingDrafts = Draft::where('status', 'pending_review')->count();
        
        $totalRevenue = Payment::where('payment_status', 'completed')->sum('amount');
        $pendingCalls = CallSchedule::where('status', 'pending')->count();
        
        $recentRequests = ServiceRequest::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalRequests', 'pendingRequests', 'approvedRequests', 'completedRequests',
            'pendingDocuments', 'pendingDrafts', 'totalRevenue', 'pendingCalls', 'recentRequests'
        ));
    }
}
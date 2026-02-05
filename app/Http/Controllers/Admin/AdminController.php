<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\User;
use App\Models\ServiceType;
use App\Models\Document;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        // Service Request Statistics
        $totalRequests = ServiceRequest::count();
        $pendingRequests = ServiceRequest::where('status', 'pending')->count();
        $approvedRequests = ServiceRequest::where('status', 'approved')->count();
        $rejectedRequests = ServiceRequest::where('status', 'rejected')->count();
        $completedRequests = ServiceRequest::where('status', 'completed')->count();
        $inProgressRequests = ServiceRequest::where('status', 'in_progress')->count();
        
        // User Statistics
        $totalUsers = User::count();
        $activeUsers = User::where('status', 'active')->count();
        
        // Service Types
        $totalServiceTypes = ServiceType::count();
        $activeServiceTypes = ServiceType::where('active', true)->count();
        
        // Documents
        $totalDocuments = Document::count();
        $pendingDocuments = Document::where('status', 'pending')->count();
        
        // Recent Activities
        $recentRequests = ServiceRequest::with(['user', 'serviceType'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Requests by Status for Chart
        $requestsByStatus = [
            'pending' => $pendingRequests,
            'approved' => $approvedRequests,
            'rejected' => $rejectedRequests,
            'in_progress' => $inProgressRequests,
            'completed' => $completedRequests
        ];
        
        // Recent Users
        $recentUsers = User::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalRequests',
            'pendingRequests',
            'approvedRequests',
            'rejectedRequests',
            'completedRequests',
            'inProgressRequests',
            'totalUsers',
            'activeUsers',
            'totalServiceTypes',
            'activeServiceTypes',
            'totalDocuments',
            'pendingDocuments',
            'recentRequests',
            'requestsByStatus',
            'recentUsers'
        ));
    }
}
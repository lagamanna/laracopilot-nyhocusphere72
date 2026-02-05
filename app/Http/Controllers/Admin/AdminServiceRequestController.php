<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class AdminServiceRequestController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $status = request('status', 'all');
        
        $query = ServiceRequest::with(['user', 'serviceType', 'documents']);
        
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $requests = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Statistics
        $totalRequests = ServiceRequest::count();
        $pendingRequests = ServiceRequest::where('status', 'pending')->count();
        $approvedRequests = ServiceRequest::where('status', 'approved')->count();
        $rejectedRequests = ServiceRequest::where('status', 'rejected')->count();
        $completedRequests = ServiceRequest::where('status', 'completed')->count();
        
        return view('admin.service-requests.index', compact(
            'requests',
            'status',
            'totalRequests',
            'pendingRequests',
            'approvedRequests',
            'rejectedRequests',
            'completedRequests'
        ));
    }
    
    public function show($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $request = ServiceRequest::with(['user', 'serviceType', 'documents'])
            ->findOrFail($id);
        
        return view('admin.service-requests.show', compact('request'));
    }
    
    public function approve($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $serviceRequest = ServiceRequest::findOrFail($id);
        
        $serviceRequest->update([
            'status' => 'approved',
            'admin_comment' => null,
            'reviewed_at' => now(),
            'reviewed_by' => session('admin_email')
        ]);
        
        return redirect()->route('admin.service-requests.show', $id)
            ->with('success', 'Service request approved successfully!');
    }
    
    public function reject(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'admin_comment' => 'required|string|min:10'
        ]);
        
        $serviceRequest = ServiceRequest::findOrFail($id);
        
        $serviceRequest->update([
            'status' => 'rejected',
            'admin_comment' => $validated['admin_comment'],
            'reviewed_at' => now(),
            'reviewed_by' => session('admin_email')
        ]);
        
        return redirect()->route('admin.service-requests.show', $id)
            ->with('success', 'Service request rejected with comments.');
    }
    
    public function complete($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $serviceRequest = ServiceRequest::findOrFail($id);
        
        if ($serviceRequest->status !== 'approved') {
            return redirect()->route('admin.service-requests.show', $id)
                ->with('error', 'Only approved requests can be marked as completed.');
        }
        
        $serviceRequest->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);
        
        return redirect()->route('admin.service-requests.show', $id)
            ->with('success', 'Service request marked as completed!');
    }
}
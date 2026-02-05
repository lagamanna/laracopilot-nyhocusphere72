<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class AdminDocumentVerificationController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $documents = Document::with('serviceRequest.user')
            ->where('verification_status', 'pending')
            ->orderBy('created_at', 'asc')
            ->paginate(15);
        
        return view('admin.documents.index', compact('documents'));
    }
    
    public function showVerify($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $document = Document::with('serviceRequest.user')->findOrFail($id);
        return view('admin.documents.verify', compact('document'));
    }
    
    public function verifyDocument(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'remarks' => 'nullable|string|max:500'
        ]);
        
        $document = Document::findOrFail($id);
        
        $document->update([
            'verification_status' => $validated['status'],
            'verification_remarks' => $validated['remarks'] ?? null,
            'verified_by' => session('admin_email'),
            'verified_at' => now()
        ]);
        
        // Update service request status if all documents approved
        $serviceRequest = $document->serviceRequest;
        $allApproved = $serviceRequest->documents()->where('verification_status', '!=', 'approved')->count() === 0;
        
        if ($allApproved && $validated['status'] === 'approved') {
            $serviceRequest->update(['status' => 'documents_verified']);
        }
        
        return redirect()->route('admin.documents.index')
            ->with('success', 'Document verification completed!');
    }
}
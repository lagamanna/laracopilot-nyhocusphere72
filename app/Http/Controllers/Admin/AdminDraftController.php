<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Draft;
use App\Models\ServiceRequest;
use App\Models\DraftChat;
use Illuminate\Http\Request;

class AdminDraftController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $drafts = Draft::with('serviceRequest.user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.drafts.index', compact('drafts'));
    }
    
    public function create($requestId)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $serviceRequest = ServiceRequest::with('user')->findOrFail($requestId);
        return view('admin.drafts.create', compact('serviceRequest'));
    }
    
    public function store(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'service_request_id' => 'required|exists:service_requests,id',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'description' => 'nullable|string|max:500'
        ]);
        
        $file = $request->file('file');
        $fileName = time() . '_draft_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('drafts', $fileName, 'public');
        
        Draft::create([
            'service_request_id' => $validated['service_request_id'],
            'file_name' => $fileName,
            'file_path' => $filePath,
            'file_size' => $file->getSize(),
            'description' => $validated['description'] ?? null,
            'uploaded_by' => session('admin_email'),
            'status' => 'pending_review'
        ]);
        
        ServiceRequest::find($validated['service_request_id'])->update(['status' => 'draft_uploaded']);
        
        return redirect()->route('admin.drafts.index')
            ->with('success', 'Draft uploaded successfully!');
    }
    
    public function show($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $draft = Draft::with(['serviceRequest.user', 'feedback', 'chatMessages'])->findOrFail($id);
        return view('admin.drafts.show', compact('draft'));
    }
}
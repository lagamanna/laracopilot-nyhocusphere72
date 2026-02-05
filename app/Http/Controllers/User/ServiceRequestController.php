<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\ServiceType;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceRequestController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $userId = session('user_id');
        $requests = ServiceRequest::where('user_id', $userId)
            ->with('serviceType')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('user.requests.index', compact('requests'));
    }
    
    public function create()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $serviceTypes = ServiceType::where('active', true)->get();
        
        return view('user.requests.create', compact('serviceTypes'));
    }
    
    public function store(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $validated = $request->validate([
            'service_type_id' => 'required|exists:service_types,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,normal,high,urgent',
            'contact_method' => 'required|in:email,phone,both',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'documents.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png'
        ]);
        
        $userId = session('user_id');
        
        $serviceRequest = ServiceRequest::create([
            'user_id' => $userId,
            'service_type_id' => $validated['service_type_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'contact_method' => $validated['contact_method'],
            'location' => $validated['location'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending'
        ]);
        
        // Handle file uploads
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('documents', $fileName, 'public');
                
                Document::create([
                    'user_id' => $userId,
                    'service_request_id' => $serviceRequest->id,
                    'document_type' => 'supporting_document',
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'file_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                    'status' => 'pending'
                ]);
            }
        }
        
        return redirect()->route('user.requests.index')->with('success', 'Service request submitted successfully!');
    }
    
    public function show($id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $userId = session('user_id');
        $request = ServiceRequest::where('user_id', $userId)
            ->where('id', $id)
            ->with(['serviceType', 'documents'])
            ->firstOrFail();
        
        return view('user.requests.show', compact('request'));
    }
    
    public function resubmit(Request $request, $id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $userId = session('user_id');
        $serviceRequest = ServiceRequest::where('user_id', $userId)
            ->where('id', $id)
            ->firstOrFail();
        
        if ($serviceRequest->status !== 'rejected') {
            return redirect()->route('user.requests.show', $id)
                ->with('error', 'Only rejected requests can be resubmitted.');
        }
        
        $validated = $request->validate([
            'description' => 'required|string',
            'notes' => 'nullable|string',
            'documents.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png'
        ]);
        
        // Update service request
        $serviceRequest->update([
            'description' => $validated['description'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
            'admin_comment' => null,
            'reviewed_at' => null,
            'reviewed_by' => null
        ]);
        
        // Handle new file uploads
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('documents', $fileName, 'public');
                
                Document::create([
                    'user_id' => $userId,
                    'service_request_id' => $serviceRequest->id,
                    'document_type' => 'supporting_document',
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'file_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                    'status' => 'pending'
                ]);
            }
        }
        
        return redirect()->route('user.requests.show', $id)
            ->with('success', 'Service request resubmitted successfully!');
    }
}
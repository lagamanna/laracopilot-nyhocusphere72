<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $userId = session('user_id');
        $documents = Document::where('user_id', $userId)
            ->with('serviceRequest')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $totalDocuments = $documents->count();
        $verifiedDocuments = $documents->where('status', 'verified')->count();
        $pendingDocuments = $documents->where('status', 'pending')->count();
        $totalSize = round($documents->sum('file_size') / 1024 / 1024, 2);
        
        return view('user.documents.index', compact(
            'documents',
            'totalDocuments',
            'verifiedDocuments',
            'pendingDocuments',
            'totalSize'
        ));
    }
    
    public function store(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $validated = $request->validate([
            'service_request_id' => 'nullable|exists:service_requests,id',
            'document_type' => 'required|string',
            'document' => 'required|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png'
        ]);
        
        $userId = session('user_id');
        $file = $request->file('document');
        
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('documents', $fileName, 'public');
        
        Document::create([
            'user_id' => $userId,
            'service_request_id' => $validated['service_request_id'] ?? null,
            'document_type' => $validated['document_type'],
            'file_name' => $fileName,
            'file_path' => $filePath,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
            'status' => 'pending'
        ]);
        
        return redirect()->route('user.documents.index')->with('success', 'Document uploaded successfully!');
    }
    
    public function download($id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $userId = session('user_id');
        $document = Document::where('user_id', $userId)
            ->where('id', $id)
            ->firstOrFail();
        
        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }
    
    public function destroy($id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $userId = session('user_id');
        $document = Document::where('user_id', $userId)
            ->where('id', $id)
            ->firstOrFail();
        
        Storage::disk('public')->delete($document->file_path);
        $document->delete();
        
        return redirect()->route('user.documents.index')->with('success', 'Document deleted successfully!');
    }
}
<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Draft;
use App\Models\DraftFeedback;
use App\Models\DraftChat;
use Illuminate\Http\Request;

class DraftReviewController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }
        
        $drafts = Draft::whereHas('serviceRequest', function($q) {
            $q->where('user_id', session('user_id'));
        })->with('serviceRequest.serviceType')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('user.drafts.index', compact('drafts'));
    }
    
    public function show($id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }
        
        $draft = Draft::whereHas('serviceRequest', function($q) {
            $q->where('user_id', session('user_id'));
        })->with(['serviceRequest', 'feedback', 'chatMessages'])
            ->findOrFail($id);
        
        return view('user.drafts.show', compact('draft'));
    }
    
    public function submitFeedback(Request $request, $id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }
        
        $validated = $request->validate([
            'satisfaction' => 'required|in:satisfied,corrections_needed',
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000'
        ]);
        
        $draft = Draft::whereHas('serviceRequest', function($q) {
            $q->where('user_id', session('user_id'));
        })->findOrFail($id);
        
        DraftFeedback::create([
            'draft_id' => $draft->id,
            'satisfaction' => $validated['satisfaction'],
            'rating' => $validated['rating'],
            'comments' => $validated['comments'] ?? null
        ]);
        
        $draft->update([
            'status' => $validated['satisfaction'] === 'satisfied' ? 'approved' : 'corrections_needed'
        ]);
        
        return back()->with('success', 'Feedback submitted successfully!');
    }
    
    public function sendChatMessage(Request $request, $id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }
        
        $validated = $request->validate([
            'message' => 'required|string|max:500'
        ]);
        
        $draft = Draft::whereHas('serviceRequest', function($q) {
            $q->where('user_id', session('user_id'));
        })->findOrFail($id);
        
        DraftChat::create([
            'draft_id' => $draft->id,
            'sender_type' => 'user',
            'sender_id' => session('user_id'),
            'message' => $validated['message']
        ]);
        
        return back()->with('success', 'Message sent!');
    }
}
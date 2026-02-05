<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function create($requestId)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }
        
        $serviceRequest = ServiceRequest::where('user_id', session('user_id'))
            ->where('id', $requestId)
            ->with('serviceType')
            ->firstOrFail();
        
        return view('user.feedback.create', compact('serviceRequest'));
    }
    
    public function store(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }
        
        $validated = $request->validate([
            'service_request_id' => 'required|exists:service_requests,id',
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
            'reference_name' => 'nullable|string|max:255',
            'reference_email' => 'nullable|email',
            'reference_phone' => 'nullable|string|max:15'
        ]);
        
        $serviceRequest = ServiceRequest::where('id', $validated['service_request_id'])
            ->where('user_id', session('user_id'))
            ->firstOrFail();
        
        Feedback::create([
            'service_request_id' => $serviceRequest->id,
            'rating' => $validated['rating'],
            'comments' => $validated['comments'] ?? null,
            'reference_name' => $validated['reference_name'] ?? null,
            'reference_email' => $validated['reference_email'] ?? null,
            'reference_phone' => $validated['reference_phone'] ?? null
        ]);
        
        return redirect()->route('call-schedule.create')
            ->with('success', 'Feedback submitted! Would you like to schedule a call with our team?');
    }
}
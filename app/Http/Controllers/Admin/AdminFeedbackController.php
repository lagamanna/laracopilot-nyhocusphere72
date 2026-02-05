<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminFeedbackController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $feedbacks = Feedback::with('serviceRequest.user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.feedback.index', compact('feedbacks'));
    }
    
    public function show($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $feedback = Feedback::with('serviceRequest.user')->findOrFail($id);
        return view('admin.feedback.show', compact('feedback'));
    }
}
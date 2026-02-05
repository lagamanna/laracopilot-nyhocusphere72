<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $payments = Payment::with('serviceRequest.user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.payments.index', compact('payments'));
    }
    
    public function show($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $payment = Payment::with('serviceRequest.user')->findOrFail($id);
        return view('admin.payments.show', compact('payment'));
    }
}
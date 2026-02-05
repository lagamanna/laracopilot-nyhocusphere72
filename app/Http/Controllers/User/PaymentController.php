<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }
        
        $payments = Payment::whereHas('serviceRequest', function($q) {
            $q->where('user_id', session('user_id'));
        })->with('serviceRequest.serviceType')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('user.payments.index', compact('payments'));
    }
    
    public function create($requestId)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }
        
        $serviceRequest = ServiceRequest::where('user_id', session('user_id'))
            ->where('id', $requestId)
            ->with('serviceType')
            ->firstOrFail();
        
        // Get all approved requests for multi-service payment
        $approvedRequests = ServiceRequest::where('user_id', session('user_id'))
            ->where('status', 'approved')
            ->whereDoesntHave('payments', function($q) {
                $q->where('payment_status', 'completed');
            })
            ->with('serviceType')
            ->get();
        
        return view('user.payments.create', compact('serviceRequest', 'approvedRequests'));
    }
    
    public function initiatePayment(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }
        
        $validated = $request->validate([
            'service_request_ids' => 'required|array',
            'service_request_ids.*' => 'exists:service_requests,id'
        ]);
        
        $totalAmount = 0;
        $serviceRequests = ServiceRequest::where('user_id', session('user_id'))
            ->whereIn('id', $validated['service_request_ids'])
            ->get();
        
        foreach ($serviceRequests as $sr) {
            $totalAmount += $sr->serviceType->price;
        }
        
        // Create payment record
        $payment = Payment::create([
            'service_request_id' => $serviceRequests->first()->id,
            'transaction_id' => 'TXN' . strtoupper(Str::random(12)),
            'amount' => $totalAmount,
            'payment_method' => 'razorpay',
            'payment_status' => 'pending'
        ]);
        
        // Simulate Razorpay payment (In production, integrate actual Razorpay API)
        $razorpayOrderId = 'order_' . strtoupper(Str::random(14));
        
        return view('user.payments.razorpay', compact('payment', 'razorpayOrderId', 'totalAmount'));
    }
    
    public function paymentCallback(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('login');
        }
        
        // Simulate payment success (In production, verify Razorpay signature)
        $paymentId = $request->input('payment_id');
        
        $payment = Payment::where('transaction_id', $request->input('transaction_id'))->first();
        
        if ($payment) {
            $payment->update([
                'payment_status' => 'completed',
                'paid_at' => now()
            ]);
            
            $payment->serviceRequest->update(['status' => 'completed']);
        }
        
        return redirect()->route('feedback.create', $payment->service_request_id)
            ->with('success', 'Payment successful! Please provide your feedback.');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'service_request_id', 'transaction_id', 'amount', 
        'payment_method', 'payment_status', 'paid_at'
    ];
    
    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime'
    ];
    
    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }
}
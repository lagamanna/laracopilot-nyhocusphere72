<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'service_request_id', 'rating', 'comments', 
        'reference_name', 'reference_email', 'reference_phone'
    ];
    
    protected $casts = [
        'rating' => 'integer'
    ];
    
    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }
}
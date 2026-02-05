<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    protected $fillable = [
        'service_request_id', 'file_name', 'file_path', 'file_size', 
        'description', 'uploaded_by', 'status'
    ];
    
    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }
    
    public function feedback()
    {
        return $this->hasOne(DraftFeedback::class);
    }
    
    public function chatMessages()
    {
        return $this->hasMany(DraftChat::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallSchedule extends Model
{
    protected $fillable = [
        'user_id', 'scheduled_at', 'topic', 'notes', 'status', 'admin_notes'
    ];
    
    protected $casts = [
        'scheduled_at' => 'datetime'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
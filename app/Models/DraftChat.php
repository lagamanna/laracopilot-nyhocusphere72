<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DraftChat extends Model
{
    protected $fillable = ['draft_id', 'sender_type', 'sender_id', 'message'];
    
    public function draft()
    {
        return $this->belongsTo(Draft::class);
    }
}
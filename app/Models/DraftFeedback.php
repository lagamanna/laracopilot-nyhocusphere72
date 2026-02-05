<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DraftFeedback extends Model
{
    protected $fillable = ['draft_id', 'satisfaction', 'rating', 'comments'];
    
    protected $casts = [
        'rating' => 'integer'
    ];
    
    public function draft()
    {
        return $this->belongsTo(Draft::class);
    }
}
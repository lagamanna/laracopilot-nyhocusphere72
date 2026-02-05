<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'user_id',
        'service_type_id',
        'title',
        'description',
        'priority',
        'contact_method',
        'location',
        'notes',
        'status',
        'admin_comment',
        'reviewed_at',
        'reviewed_by',
        'completed_at'
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
        'completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function callSchedules()
    {
        return $this->hasMany(CallSchedule::class);
    }

    public function drafts()
    {
        return $this->hasMany(Draft::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
}
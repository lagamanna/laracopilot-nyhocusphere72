<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'pin',
        'address',
        'email_verification_token',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'pin',
        'remember_token',
        'email_verification_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }
    
    public function callSchedules()
    {
        return $this->hasMany(CallSchedule::class);
    }
}
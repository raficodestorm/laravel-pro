<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'username',
        'email',
        'password',
        'father_name',
        'phone',
        'address',
        'nid_no',
        'counter_id',
        'profile_photo_path',
        'role',
        'status',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // helper
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isManager(): bool
    {
        return $this->role === 'counter_manager';
    }

    public function isController(): bool
    {
        return $this->role === 'controller';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function counter()
    {
        return $this->belongsTo(Counter::class);
    }
    public function tickets()
    {
        return $this->hasMany(\App\Models\Ticket::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'reservation_id',
        'pnr',
        'file_path',
    ];

    public function reservation()
    {
        return $this->belongsTo(SeatReservation::class, 'reservation_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}

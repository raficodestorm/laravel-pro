<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'bus_type',
        'coach_no',
        'route',
        'seat_price',
        'departure',
        'selected_seats',
        'total',
        'boarding',
        'dropping',
        'name',
        'mobile',
    ];
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'schedule_id',
        'bus_type',
        'coach_no',
        'route',
        'seat_price',
        'departure',
        'boarding',
        'dropping',
        'selected_seats',
        'total',
        'status',
        'name',
        'mobile',
    ];
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
    public function ticket()
    {
        return $this->hasOne(Ticket::class, 'reservation_id', 'id');
    }
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}

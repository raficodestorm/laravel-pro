<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'set_date',
        'set_time',
        'route_code',
        'start_location',
        'end_location',
        'distance',
        'duration',
        'price',
        'bus_type',
        'coach_no',
        'status',
        'driver_id',
        'supervisor_id',
    ];
    public function bus()
    {
        return $this->belongsTo(Bus::class, 'coach_no', 'coach_no');
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }
}

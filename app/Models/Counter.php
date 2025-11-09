<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Location;

class Counter extends Model
{
    protected $fillable = [
        'id',
        'name',
        'manager',
        'location_id',
        'distance',
        'address',
    ];

    public function locationinfo()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }
}

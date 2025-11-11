<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'id',
        'route_code',
        'start_location',
        'end_location',
        'distance',
        'duration',
    ];

    public function drivers()
    {
        return $this->hasMany(Driver::class, 'route_id');
    }
}

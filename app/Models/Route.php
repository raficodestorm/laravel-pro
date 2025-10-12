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
    ];
}

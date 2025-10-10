<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'id',
        'name',
        'coach_no',
        'license',
        'conpany',
        'route',
    ];
}

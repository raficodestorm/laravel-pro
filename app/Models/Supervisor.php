<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $fillable = [
        'name',
        'father',
        'phone',
        'address',
        'route_id',
    ];

    public function routeinfo()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}

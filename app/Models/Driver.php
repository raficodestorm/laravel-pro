<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'name',
        'father',
        'phone',
        'license',
        'address',
        'route_id',
    ];

    public function routeinfo()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}

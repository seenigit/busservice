<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    public function stations()
    {
        return $this->belongsToMany(Station::class)
            ->withPivot(['station_order', 'arrival_time'])
            ->withTimestamps();
    }
}

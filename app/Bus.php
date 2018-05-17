<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    public function stations()
    {
        return $this->belongsToMany(Station::class)
            ->withPivot(['station_order', 'arrival_time'])
            ->orderBy('station_order')
            ->withTimestamps();
    }

    public function busType()
    {
        return $this->belongsTo(BusType::class);
    }
}

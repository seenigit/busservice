<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    public function buses()
    {
        return $this->belongsToMany(Bus::class)
            ->withPivot(['station_order', 'arrival_time'])
            ->orderBy('station_order')
            ->withTimestamps();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusType extends Model
{
    public function bus()
    {
        return $this->hasOne(Bus::class);
    }
}

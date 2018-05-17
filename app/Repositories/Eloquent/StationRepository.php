<?php

namespace App\Repositories\Eloquent;

use App\Station;
use App\Repositories\Contracts\StationRepositoryInterface;

class StationRepository implements StationRepositoryInterface
{
    /**
     * @var $station
     */
    private $station;

    public function __construct(Station $station)
    {
        $this->station = $station;
    }

    public function getStations()
    {
        return Station::get();
    }
}

<?php

namespace App\Repositories\Eloquent;

use App\Station;

use App\Repositories\Contracts\StationRepositoryInterface;

class StationRepository implements StationRepositoryInterface
{
    /**
     * @var App\Station;
     */
    private $station;

    public function __construct(Station $station)
    {
        $this->station = $station;
    }

    /**
     * Get all stations
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getStations()
    {
        return Station::get();
    }

    /**
     * Get all stations
     *
     * @param array $stationNames
     *
     * @return array
     */
    public function getStationIdsByNames(array $stationNames) {
        return $this->station->whereIn('name', $stationNames)->pluck('id');
    }

    /**
     * Get station by name
     *
     * @param array $stationNames
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function searchStationByName($name) {
        return $this->station->where('name','LIKE',"%{$name}%")->get();
    }
}

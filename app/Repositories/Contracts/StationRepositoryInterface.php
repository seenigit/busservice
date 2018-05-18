<?php

namespace App\Repositories\Contracts;

interface StationRepositoryInterface
{
    public function getStations();

    public function getStationIdsByNames(array $stationNames);

    public function searchStationByName($name);
}

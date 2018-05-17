<?php

namespace App\Repositories\Contracts;

interface BusRepositoryInterface
{
    public function addBus($data);

    public function updateBus($data);

    public function deleteBus($busId);

    public function getBuses();

    public function getBus($busId);
}

<?php

namespace App\Repositories\Eloquent;

use App\BusType;
use App\Repositories\Contracts\BusTypeRepositoryInterface;

class BusTypeRepository implements BusTypeRepositoryInterface
{
    /**
     * @var $busType
     */
    private $busType;

    public function __construct(BusType $busType)
    {
        $this->busType = $busType;
    }

    public function getBusTypes()
    {
        return $this->busType->get();
    }
}

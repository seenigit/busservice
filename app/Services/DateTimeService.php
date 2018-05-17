<?php

namespace App\Services\DateTime;

use Carbon\Carbon;

class DateTimeService
{
    /**
     * @var Carbon
     */
    private $carbon;

    public function __construct(Carbon $carbon)
    {
        $this->carbon = $carbon;
    }

    public function now($time_zone = 'UTC')
    {
        return $this->carbon->now($time_zone);
    }

    public function today($time_zone = 'UTC')
    {
        return  $date = $this->carbon->today($time_zone);
    }

    public function tomorrow($time_zone = 'UTC')
    {
        return $this->carbon->tomorrow($time_zone)->toDateString();
    }

    public function yesterday($time_zone = 'UTC')
    {
        return $this->carbon->yesterday($time_zone)->toDateString();
    }

    public function addMonth($date)
    {
        return Carbon::parse($date)->addMonth();
    }
}

<?php

namespace App\Repositories\Eloquent;

use App\Bus;
use App\Repositories\Contracts\BusRepositoryInterface;

class BusRepository implements BusRepositoryInterface
{
    /**
     * @var $bus
     */
    private $bus;

    public function __construct(Bus $bus)
    {
        $this->bus = $bus;
    }

    public function addBus($data)
    {
        $bus = $this->checkBusExists($data['name']);
        if($bus->isEmpty())
        {
            $bus = $this->bus->newInstance();
            $bus->name = $data['name'];
            $bus->bus_type_id = $data['busType'];
            $bus->station_wait_time_mins = $data['stationWaitTimeMins'];
            try{
                $bus->save();
                $this->addStations($bus, $data);
            } catch (Exception $ex) {
                return ['status' => false, 'message' => 'Something went wrong, please try again later.'];
            }
            return ['status' => true, 'message' => 'Bus has been created successfully'];
        }
        return ['status' => false, 'message' => 'This bus already exists'];
    }

    public function addStations(Bus $bus, $data) {
        $busStations = array();
        foreach($data['stations'] as $key => $station) {
            $busStations[$station] = ['station_order' => $data['stationOrder'][$key],
                                           'arrival_time' => $data['arrivalTime'][$key]];
        }
        $bus->stations()->sync($busStations);
    }

    public function updateBus($data)
    {
        $bus = $this->getBus($data['busId']);
        if($bus) {
            $bus->name = $data['name'];
            $bus->bus_type = $data['busType'];
            $bus->station_wait_time_mins = $data['stationWaitTimeMins'];
            $this->addStations($bus, $data);
            try{
                $bus->save();
            } catch (Exception $ex) {
                return ['status' => false, 'message' => 'Something went wrong, please try again later.'];
            }
            return ['status' => true, 'message' => 'Bus has been updated successfully'];
        }
        return ['status' => false, 'message' => 'This bus already exists'];
    }

    public function getBuses()
    {
        return Bus::get();
    }
    
    public function deleteBus($busId)
    {
        $bus = $this->getBus($busId);
        if($bus) {
            $bus->stations()->detach();
            $bus->delete();
            return ['success' => true, 'message' => 'Bus deleted successfully'];
        }
        return ['success' => false, 'message' => 'Bus not found'];

    }
    
    public function getBus($busId)
    {
        $bus = Bus::find($busId);
        return $bus;
    }
    
    public function checkBusExists($busName)
    {
        $bus = Bus::where('name',$busName)->get();
        return $bus;
    }
}

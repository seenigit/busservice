<?php

namespace App\Repositories\Eloquent;

use App\Bus;

use App\Repositories\Contracts\BusRepositoryInterface;

class BusRepository implements BusRepositoryInterface
{
    /**
     * @var App\Bus
     */
    private $bus;

    public function __construct(Bus $bus)
    {
        $this->bus = $bus;
    }

    /**
     * Add bus
     *
     * @param Array $data
     *
     * @return Array
     */
    public function addBus($data)
    {
        //check if this bus already exists
        $bus = $this->checkBusExists($data['name']);
        
        if (!$bus) {

            //Create new bus collection
            $bus = $this->bus->newInstance();
            $bus->name = $data['name'];
            $bus->bus_type_id = $data['busType'];

            try {

                //Save bus
                $bus->save();

                //save other details in pivot table
                $this->addStations($bus, $data);

            } catch (Exception $ex) {
                return ['status' => false, 'message' => 'Something went wrong, please try again later.'];
            }

            return ['status' => true, 'message' => 'Bus has been created successfully'];
        }
        return ['status' => false, 'message' => 'This bus already exists'];
    }

    /**
     * Add stations
     *
     * @param App\Bus $bus
     * @param Array $data
     *
     * @return void
     */
    public function addStations(Bus $bus, $data)
    {
        $busStations = array();

        foreach ($data['stations'] as $key => $station) {
            $busStations[$station] = [
                'station_order' => $data['stationOrder'][$key],
                'arrival_time' => $data['arrivalTime'][$key]
            ];
        }

        //Delete existing stations and insert new stations(As this code is used for update as well)
        $bus->stations()->sync($busStations);
    }

    /**
     * Update stations
     *
     * @param Array $data
     *
     * @return array
     */
    public function updateBus($data)
    {
        $bus = $this->getBus($data['busId']);

        if ($bus) {

            $bus->name = $data['name'];
            $bus->bus_type_id = $data['busType'];

            try {

                //Update bus first
                $bus->save();

                //Save other details in pivot table
                $this->addStations($bus, $data);

            } catch (Exception $ex) {
                return ['status' => false, 'message' => 'Something went wrong, please try again later.'];
            }
            return ['status' => true, 'message' => 'Bus has been updated successfully'];
        }
        return ['status' => false, 'message' => 'This bus already exists'];
    }

    /**
     * Get all buses
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getBuses()
    {
        return Bus::get();
    }

    /**
     * Delete bus
     *
     * @param integer $busId
     *
     * @return array
     */
    public function deleteBus($busId)
    {
        $bus = $this->getBus($busId);
        if ($bus) {

            //Delete all records which are mapped with this bus in pivot table first
            $bus->stations()->detach();

            $bus->delete();

            return ['success' => true, 'message' => 'Bus deleted successfully'];
        }
        return ['success' => false, 'message' => 'Bus not found'];

    }

    /**
     * Get bus
     *
     * @param integer $busId
     *
     * @return App\Bus
     */
    public function getBus($busId)
    {
        $bus = Bus::find($busId);
        return $bus;
    }

    /**
     * Get bus by name
     *
     * @param string $busName
     *
     * @return App\Bus
     */
    public function checkBusExists($busName)
    {
        $bus = Bus::where('name',$busName)->first();
        return $bus;
    }

    /**
     * Get buses id by station id
     *
     * @param int $stationId
     *
     * @return array
     */
    public function getBusIdByStationId($stationId) {
        return $this->bus->whereHas('stations', function($query) use($stationId) {
            $query->where('stations.id', $stationId);
        })->pluck('buses.id');
    }

    /**
     * Check if bus contain station id
     *
     * @param array $busIds
     * @param int $stationId
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function checkBusesContainStationId($busIds, $stationId) {
        return $this->bus->whereHas('stations', function($query) use($busIds, $stationId) {
            $query->whereIn('buses.id',$busIds)
                  ->where('stations.id', $stationId);
        })->get();
    }
}

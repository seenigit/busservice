<?php

namespace App\Http\Controllers;

use App\Bus;

use App\Station;

use Illuminate\Http\Request;

use App\Repositories\Contracts\BusRepositoryInterface;

use App\Repositories\Contracts\StationRepositoryInterface;

use Session;

class HomeController extends Controller
{

    /**
     * @var App\Repositories\Contracts\BusRepositoryInterface
     */
    protected $busRepository;

    /**
     * @var App\Repositories\Contracts\StationRepositoryInterface
     */
    protected $stationRepository;

    /**
     * Create a new controller instance.
     *
     * @param App\Repositories\Contracts\BusRepositoryInterface $busRepository
     * @param App\Repositories\Contracts\StationRepositoryInterface $stationRepository
     *
     * @return void
     */
    public function __construct(BusRepositoryInterface $busRepository, StationRepositoryInterface $stationRepository)
    {
        $this->busRepository = $busRepository;
        $this->stationRepository = $stationRepository;
    }

    /**
     * Search buses
     *
     * @param Request $request
     *
     * @return Illuminate\View
     */
    public function searchBus(Request $request)
    {
        if ($request->isMethod('post')) {
            $from = $request->input('from');
            $to = $request->input('to');
            //first lets get stations id for the searched stations
            $stations = $this->stationRepository->getStationIdsByNames([$from, $to]);

            if (!$stations->isEmpty() && count($stations) == 2) {
                //Get origin location buses
                $buses = $this->busRepository->getBusIdByStationId($stations[0]);

                //Get only buses going to the destination
                $buses = $this->busRepository->checkBusesContainStationId($buses, $stations[1]);

                return view('user.home',['buses' => $buses]);
            }

            return view('user.home');
        }

        //By default display all the buses
        $buses = $this->busRepository->getBuses();
        return view('user.home',['buses' => $buses]);
    }

    /**
     * Search stations
     *
     * @param Request $request
     *
     * @return json
     */
    public function autocompleteLocation(Request $request)
    {
        $query = $request->input('query');
        $locations = $this->stationRepository->searchStationByName($query);
        $locArray = array();
        foreach ($locations as $key => $location) {
            $locArray[$key]['input_text'] = $location->name;
            $locArray[$key]['input_value'] = $location->name;
        }
        return response()->json($locArray);
    }
}

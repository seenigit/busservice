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
     * @var $busRepository
     */
    protected $busRepository;

    /**
     * @var $stationRepository
     */
    protected $stationRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BusRepositoryInterface $busRepository, StationRepositoryInterface $stationRepository)
    {
        $this->busRepository = $busRepository;
        $this->stationRepository = $stationRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function searchBus(Request $request)
    {
        if ($request->isMethod('post')) {
            $from = $request->input('from');
            $to = $request->input('to');
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
        $buses = $this->busRepository->getBuses();
        return view('user.home',['buses' => $buses]);
    }

    public function autocompleteLocation()
    {
        $query = request()->get('query','');
        $locations = $this->stationRepository->searchStationByName($query);
        $locArray = array();
        foreach ($locations as $key => $location) {
            $locArray[$key]['input_text'] = $location->name;
            $locArray[$key]['input_value'] = $location->name;
        }
        return response()->json($locArray);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Contracts\UserRepositoryInterface;

use App\Repositories\Contracts\BusRepositoryInterface;

use App\Repositories\Contracts\StationRepositoryInterface;

use App\Repositories\Contracts\BusTypeRepositoryInterface;

use Session;

use Redirect;

use Validator;

class AdminController extends Controller
{
    /**
     * @var App\Repositories\Contracts\UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @var App\Repositories\Contracts\BusRepositoryInterface
     */
    protected $busRepository;

    /**
     * @var App\Repositories\Contracts\StationRepositoryInterface
     */
    protected $stationRepository;

    /**
     * @var App\Repositories\Contracts\BusTypeRepositoryInterface
     */
    protected $busTypeRepository;

    /**
     * Create a new controller instance.
     *
     * @param App\Repositories\Contracts\UserRepositoryInterface $userRepository
     * @param App\Repositories\Contracts\BusRepositoryInterface $busRepository
     * @param App\Repositories\Contracts\StationRepositoryInterface $stationRepository
     * @param App\Repositories\Contracts\BusTypeRepositoryInterface $busTypeRepository
     *
     * @return void
     */

    public function __construct(
        UserRepositoryInterface $userRepository,
        BusRepositoryInterface $busRepository,
        StationRepositoryInterface $stationRepository,
        BusTypeRepositoryInterface $busTypeRepository
    ) {
        $this->userRepository = $userRepository;
        $this->busRepository = $busRepository;
        $this->stationRepository = $stationRepository;
        $this->busTypeRepository = $busTypeRepository;
    }

    /**
     * Show login page
     *
     * @return Illuminate\View
     */
    public function showLogin()
    {
        return view('admin.login');
    }

    /**
     * Get all users
     *
     * @return Illuminate\View
     */
    public function getDashboard()
    {
        $users = $this->userRepository->getUsers(config('constants.roles.PASSENGER'));
        return view('admin.dashboard', array('users' => $users));
    }

    /**
     * Add user
     *
     * @param Request $request
     *
     * @return Illuminate\View
     */
    public function addUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data['name'] = $request->input ('name');
            $data['email'] = $request->input ('email');
            $data['address'] = $request->input ('address');
            $data['city'] = $request->input ('city');
            $data['password'] = $request->input ('password');
            $response = $this->userRepository->addUser($data);
            Session::flash('message', $response['message']);
        }
        else
        {
            Session::forget('message');
        }
        return view('admin.useradd');
    }

    /**
     * Edit user
     *
     * @param integer $userId
     * @param Request $request
     *
     * @return Illuminate\View | string
     */
    public function editUser($userId, Request $request)
    {
        if ($request->input('id'))
            $userId = $request->input ('id');
        $user = $this->userRepository->getUser($userId);
        if ($user) {
            if ($request->isMethod('post')) {
                $data['userId'] = $userId;
                $data['name'] = $request->input ('name');
                $data['email'] = $request->input ('email');
                $data['address'] = $request->input ('address');
                $data['city'] = $request->input ('city');
                $response = $this->userRepository->updateUser($data);
                $user = $this->userRepository->getUser($userId);
                Session::flash('message', $response['message']);
            }
            return view('admin.useredit', array('user' => $user));
        }
        else
        {
            return "User does not exists";
        }
    }

    /**
     * Delete user
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function deleteUser(Request $request)
    {
        $userId = $request->input ('id');
        $this->userRepository->deleteUser($userId);
        return Redirect::to('/admin/dashboard');
    }

    /**
     * Get buses
     *
     * @param Request $request
     *
     * @return Illuminate\View | string
     */
    public function busList()
    {
        $buses = $this->busRepository->getBuses();
        return view('admin.buslist', array('buses' => $buses));
    }

    /**
     * Add bus
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function addBus(Request $request)
    {
        if ($request->isMethod('post')) {
            $validationRules = ['name' => 'required|unique:buses',
                'stations' => 'required',
                'stationOrder.*' => 'required|numeric',
                'arrivalTime.*' => ['required',
                    'regex:/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/']];
            $validate = Validator::make(request()->all(), $validationRules);
            if ($validate->fails()) {
                return redirect(url('/admin/addbus'))->withErrors($validate)->withInput();
            }
            $data['name'] = $request->input ('name');
            $data['stations'] = $request->input ('stations');
            $data['busType'] = $request->input ('busType');
            $data['stationOrder'] = $request->input ('stationOrder');
            $data['arrivalTime'] = $request->input ('arrivalTime');
            $response = $this->busRepository->addBus($data);
            Session::flash('message', $response['message']);
        }
        else
        {
            Session::forget('message');
        }
        $stations = $this->stationRepository->getStations();
        $busTypes = $this->busTypeRepository->getBusTypes();
        return view('admin.addbus', array('stations' => $stations, 'busTypes' => $busTypes));
    }

    /**
     * Delete bus
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function deleteBus(Request $request)
    {
        $busId = $request->input ('id');
        $response = $this->busRepository->deleteBus($busId);
        Session::flash('message', $response['message']);
        return Redirect::to('admin/buslist');
    }
}

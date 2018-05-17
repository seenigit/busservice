<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\BusRepositoryInterface;
use App\Repositories\Contracts\StationRepositoryInterface;
use App\Repositories\Contracts\BusTypeRepositoryInterface;
use Session;

class AdminController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @var BusRepositoryInterface
     */
    protected $busRepository;

    /**
     * @var BusRepositoryInterface
     */
    protected $stationRepository;

    /**
     * @var BusRepositoryInterface
     */
    protected $busTypeRepository;

    public function __construct(UserRepositoryInterface $userRepository, BusRepositoryInterface $busRepository,
                                StationRepositoryInterface $stationRepository, BusTypeRepositoryInterface $busTypeRepository)
    {
        $this->userRepository = $userRepository;
        $this->busRepository = $busRepository;
        $this->stationRepository = $stationRepository;
        $this->busTypeRepository = $busTypeRepository;
    }

    public function getLogin()
    {
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (\Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return \Redirect::intended('/admin/dashboard');
        }

        return \Redirect::back()
            ->withInput()
            ->withErrors('That email/password does not exist.');
    }

    public function getDashboard() {
        $users = $this->userRepository->getUsers(2);
        return view('admin.dashboard', array('users' => $users));
    }

    public function addUser(Request $request) {
        if ($request->isMethod('post'))
        {
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

    public function editUser($userId, Request $request) {
        if($request->input ('id'))
            $userId = $request->input ('id');
        $user = $this->userRepository->getUser($userId);
        if($user) {
            if ($request->isMethod('post'))
            {
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

    public function deleteUser(Request $request)
    {
        $userId = $request->input ('id');
        $this->userRepository->deleteUser($userId);
        return \Redirect::intended('/admin/dashboard');
    }

    public function busList() {
        $buses = $this->busRepository->getBuses();
        return view('admin.buslist', array('buses' => $buses));
    }

    public function addBus(Request $request) {
        if ($request->isMethod('post'))
        {
            $validationRules = ['name' => 'required|unique:buses',
                'stationWaitTimeMins' => 'required|numeric',
                'stations' => 'required',
                'stationOrder.*' => 'required|numeric',
                'arrivalTime.*' => ['required',
                    'regex:/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/']];
            $validate = \Validator::make(request()->all(), $validationRules);
            if($validate->fails())
            {
                return redirect(url('/admin/addbus'))->withErrors($validate)->withInput();
            }
            $data['name'] = $request->input ('name');
            $data['stations'] = $request->input ('stations');
            $data['busType'] = $request->input ('busType');
            $data['stationWaitTimeMins'] = $request->input ('stationWaitTimeMins');
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

    public function deleteBus(Request $request)
    {
        $busId = $request->input ('id');
        $response = $this->busRepository->deleteBus($busId);
        Session::flash('message', $response['message']);
        return \Redirect::to('admin/buslist');
    }
}
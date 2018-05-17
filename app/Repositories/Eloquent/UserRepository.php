<?php

namespace App\Repositories\Eloquent;

use App\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var $bus
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function addUser($data)
    {
        $user = $this->checkUserExistsByEmail($data['email']);
        if($user->isEmpty()) 
        {
            $user = $this->user->newInstance();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->role_id = 2;
            $user->password = app('hash')->make($data['password']);
            try{
                $user->save();
            } catch (Exception $ex) {
                return ['status' => false, 'message' => 'Something went wrong, please try again later.'];
            }
            return ['status' => true, 'message' => 'User has been added successfully'];
        }
        return ['status' => false, 'message' => 'This email id already exists'];
    }

    public function updateUser($data)
    {
        $user = User::find($data['userId']);
        if($user) 
        {
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            try{
                $user->save();
            } catch (Exception $ex) {
                return ['message' => 'Something went wrong, please try again later.'];
            }
            return ['message' => 'User has been updated successfully'];
        }
        return ['message' => 'This email id already exists'];
    }

    public function getUsers($roleId)
    {
        return User::where('role_id', $roleId)->get();
    }
    
    public function deleteUser($userId)
    {
        $user = User::find($userId);
        $user->delete();
    }
    
    public function getUser($userId)
    {
        $user = User::find($userId);
        return $user;
    }
    
    public function checkUserExistsByEmail($email)
    {
        $user = User::where('email',$email)->get();
        return $user;
    }
}

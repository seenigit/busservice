<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function addUser($data);

    public function updateUser($data);

    public function deleteUser($userId);

    public function getUsers($roleId);

    public function getUser($userId);
}

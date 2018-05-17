<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    /**
     * Add user
     *
     * @param array $data
     * @param string $password
     *
     * @return \App\User
     */
    public function addUser($data);

    public function updateUser($data);

    public function deleteUser($userId);

    public function getUsers($roleId);

    public function getUser($userId);
}

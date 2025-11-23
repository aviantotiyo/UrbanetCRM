<?php

namespace App\Services\Radius;

class RadiusService
{
    protected $userRepo;

    public function __construct(RadiusUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function registerUser($username, $password)
    {
        if ($this->userRepo->getUserByUsername($username)) {
            return 'User already exists';
        }

        $this->userRepo->createUser($username, $password);
        return 'User registered';
    }

    public function removeUser($username)
    {
        $this->userRepo->deleteUser($username);
    }
}

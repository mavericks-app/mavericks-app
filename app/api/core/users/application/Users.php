<?php

/*
Author: David
Fecha: 12/05/2024
*/
namespace App\api\core\users\application;

use App\api\core\users\domain\User;
use Mockery\Exception;

class Users
{
    protected $userService;

    public function __construct(UserContract $userService)
    {
        $this->userService=$userService;

    }

    public function login($credentials)
    {

        if($this->userService->autenticate($credentials)){

            $userModel = $this->userService->getUser();
            $userDomain= User::create($userModel->toArray());
            $userDomain->setToken($this->userService->getToken());

            return $userDomain;

        }else{
            return false;
        }


    }


}

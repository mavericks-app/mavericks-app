<?php

/*
Author: David
Fecha: 12/05/2024
*/
namespace App\api\core\users\application;

use App\api\core\shared\contracts\domain\BaseDomain;
use App\api\core\users\domain\UserContract;
use App\api\core\shared\contracts\application\BaseApplication;
use App\api\core\shared\contracts\domain\RepositoryBD;
use App\api\core\users\infrastructure\UserRepository;
use App\api\core\users\domain\User;


class Users extends BaseApplication
{

    protected RepositoryBD $repository;
    protected  $domainClass;
    protected UserContract $userService;

    public function __construct(UserContract $userService,RepositoryBD $repository)
    {
        $this->repository=$repository;
        $this->userService=$userService;
        $this->domainClass=User::class;

    }

    public function login($credentials)
    {

        if($this->userService->autenticate($credentials)){

            $userModel = $this->userService->getUser();
            $userDomain= $this->domainClass::create($userModel->toArray());
            $userDomain->setToken($this->userService->getToken());

            return $userDomain;

        }else{
            return false;
        }


    }

    public function logout()
    {

        return $this->userService->logout();
    }



}

<?php

/*
Author: David
Fecha: 12/05/2024
*/
namespace App\api\core\users\application;


use App\api\core\users\domain\UserContract;
use App\api\core\shared\contracts\application\BaseApplication;
use App\api\core\shared\contracts\domain\RepositoryBD;
use App\api\core\users\infrastructure\UserRepository;
use App\api\core\users\domain\User;
use App\Enums\UserRole;


class Users extends BaseApplication
{

    protected UserRepository $repository;
    protected  $domainClass;
    protected UserContract $userService;

    public function __construct(UserContract $userService,RepositoryBD $repository)
    {

        parent::__construct();
        $this->repository=$repository;
        $this->userService=$userService;
        $this->domainClass=User::class;

    }

    public function login($credentials)
    {

        if($this->userService->autenticate($credentials)){

            $userModel = $this->userService->getUser();
            $userDomain= $this->domainClass::create($userModel->toArray());

            $userDomain->setRoles($this->userService->getRoles());
            $userDomain->setPermissions($this->userService->getPermissions());
            $userDomain->setToken($this->userService->getToken());

            return $userDomain;

        }else{
            return false;
        }


    }



    public function store($data)
    {
        if($this->repository->checkUniqueEmail($data["email"])) {

            if(!isset($data["roles"])){
                $data["roles"]=[UserRole::User];
            }

              $domain=parent::store($data);

               if($domain->getId()>0){
                   $this->userService->assignRoleUser($domain->getId(),$data["roles"]);
                   $domain->setRoles($this->userService->getRoles($domain->getId()));
               }

           return $domain;

           }else{
             throw new \Exception("User exists email");
        }
    }

    public function logout()
    {

        return $this->userService->logout();
    }

    public function whoami()
    {
        $domain=$this->domainClass::create($this->userService->getUser()->toArray());
        $userModel = $this->userService->getUser();
        $domain->setRoles($this->userService->getRoles());
        return $domain;

    }

    public function getUserService()
    {
        return $this->userService;
    }



}

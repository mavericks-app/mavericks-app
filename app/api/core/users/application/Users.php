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

            $userDomain = $this->userService->getUser();
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

            $this->checkRoles($data["roles"]);

            $domain=parent::store($data);

            $this->assingRoles($domain, $data["roles"]);

            return $domain;

           }else{
             throw new \Exception("User exists email");
        }
    }

    public function update($data)
    {

            if(!isset($data["roles"])){
                $data["roles"]=[UserRole::User];
            }

            $this->checkRoles($data["roles"]);

            $domain=parent::update($data);

            $this->assingRoles($domain, $data["roles"]);

            return $domain;

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

    /**
     * @param $roles
     * @return void
     * @throws \Exception
     */
    public function checkRoles($roles): void
    {
        if (in_array(UserRole::SuperAdmin->value, $roles) && !$this->userService->hasRole([UserRole::SuperAdmin])) {
            throw new \Exception("Assign role need user superadmin");
        }
    }

    /**
     * @param $domain
     * @param $roles
     * @return void
     */
    public function assingRoles(&$domain, $roles): void
    {
        if ($domain->getId() > 0) {
            $this->userService->assignRoleUser($domain->getId(), $roles);
            $domain->setRoles($this->userService->getRoles($domain->getId()));
        }
    }


}

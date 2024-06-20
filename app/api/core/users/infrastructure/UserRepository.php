<?php

/*
Author: David
Fecha: 20/05/2024
*/


namespace App\api\core\users\infrastructure;
use App\api\core\users\domain\User;
use App\api\core\shared\contracts\infrastructure\EloquentRepository;
use App\api\core\shared\contracts\domain\BaseDomain;
use App\Models\User as UserApp;


class UserRepository extends EloquentRepository
{
    public function __construct(UserApp $userModel, User $userDomain)
    {
        parent::__construct($userModel, $userDomain);
    }

    public function checkUniqueEmail($email)
    {
        $users= $this->where(["email"=>$email]);
        return !($users->count()>0);
    }

    public function contacts()
    {
        return $this->model->contacts;
    }

    public function find($id):?BaseDomain{
        $this->model=$this->model::findOrFail($id);
        if($this->model){
            $domain= $this->domain::create($this->model->toArray());
            $roles=$this->model->getRoleNames()->toArray();
            $domain->setRoles(implode(",",$roles));
            return $domain;
        }
        return null;
    }



}

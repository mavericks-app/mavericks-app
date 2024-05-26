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
}

<?php

/*
Author: David
Fecha: 12/05/2024
*/
namespace App\api\agencies\application;

use App\api\core\shared\contracts\domain\BaseDomain;
use App\api\core\shared\contracts\application\BaseApplication;
use App\api\core\shared\contracts\domain\RepositoryBD;
use App\api\agencies\infrastructure\AgencyRepository;
use App\api\agencies\domain\Agency;
use App\api\core\users\domain\User;


class Agencies extends BaseApplication
{

    protected AgencyRepository $repository;
    protected  $domainClass;
    public function __construct(RepositoryBD $repository)
    {
        parent::__construct();
        $this->repository=$repository;
        $this->domainClass=Agency::class;

    }

    public function getId($id)
    {
        $agency= $this->repository->find($id);

        /*
         * Ejemplo relacion users
         $arrUsers=[];
        $users=$this->repository->getModel()->users;
        if($users->count()>0){
            foreach($users as $user){
                $arrUsers[]=User::create($user->toArray());
            }
        }

        */

        return $agency;


    }

}

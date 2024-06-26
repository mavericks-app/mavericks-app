<?php

/*
Author: David
Fecha: 12/05/2024
*/
namespace App\api\agencies\application;

use App\api\core\shared\contracts\application\BaseApplication;
use App\api\core\shared\contracts\domain\RepositoryBD;
use App\api\agencies\infrastructure\AgencyRepository;
use App\api\agencies\domain\Agency;
use App\api\core\users\application\Users;
use App\Enums\UserRole;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class Agencies extends BaseApplication
{

    protected AgencyRepository $repository;
    protected  $domainClass;
    public function __construct(RepositoryBD $repository)
    {
        parent::__construct();
        $this->repository=$repository;
        $this->domainClass=Agency::class;
        $this->userService=$user=App::make(Users::class)->getUserService();

    }

    public function getId($id)
    {

        $user=$this->userService->getUser();
        if($user->getAgencyId()==$id || $user->hasRoles([UserRole::SuperAdmin->value])) {
            $agency = $this->repository->find($id);
        }else{
            throw new  UnauthorizedHttpException("Not permissions agency");
        }


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

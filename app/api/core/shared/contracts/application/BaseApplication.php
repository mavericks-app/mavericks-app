<?php

/*
Author: David
Fecha: 20/05/2024
*/


namespace App\api\core\shared\contracts\application;

use App\api\core\shared\contracts\domain\RepositoryBD;

abstract class BaseApplication
{


    public function store($data)
    {

        $userDomain=$this->domainClass::create($data);
        $user=$this->repository->save($userDomain);
        return $user;

    }

    public function update($data)
    {
        $userDomain=$this->domainClass::create($data);
        $user=$this->repository->update($userDomain);
        return $user;

    }

    public function remove($id)
    {
        return $this->repository->remove($id);
    }

    public function getId($id)
    {
        return $this->repository->find($id);
    }
    public function index($data=[])
    {
        $arr=$this->repository->get();
        $users=[];
        if(count($arr)>0){
            foreach($arr as $row) {
                $users[] = $this->domainClass::create($row);
            }
        }

        return $users;
    }

    public function paginate($data=[])
    {
        $arr=$this->repository->paginate();
        if(count($arr["data"])>0){
            foreach($arr["data"] as $index => $row) {
                $arr["data"][$index]= $this->domainClass::create($row);
            }
        }

        return $arr;
    }

}

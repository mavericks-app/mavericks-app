<?php

/*
Author: David
Fecha: 20/05/2024
*/


namespace App\api\core\shared\contracts\application;

use App\api\core\shared\contracts\domain\RepositoryBD;

abstract class BaseApplication
{

    public function __construct()
    {

    }

    public function store($data)
    {

        $modelDomain=$this->domainClass::create($data);
        $modelDomain=$this->repository->save($modelDomain);
        return $modelDomain;

    }

    public function update($data)
    {
        $modelDomain=$this->domainClass::create($data);
        $modelDomain=$this->repository->update($modelDomain);
        return $modelDomain;

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
        $models=[];
        if(count($arr)>0){
            foreach($arr as $row) {
                $models[] = $this->domainClass::create($row);
            }
        }

        return $models;
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

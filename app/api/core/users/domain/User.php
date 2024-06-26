<?php

/*
Author: David
Fecha: 15/05/2024
*/


namespace App\api\core\users\domain;
use App\api\core\shared\contracts\domain\BaseDomain;


class User extends BaseDomain implements \JsonSerializable
{
    public int $id;
    public string $name;
    public string $email;
    public \DateTime $created_at;
    public \DateTime $updated_at;
    public string $token="";
    public string $password;
    public int $agency_id;
    public array $roles=[];
    public array $permissions=[];


    public function getId()
    {
        return $this->id;
    }

    public function getAgencyId(){
        return $this->agency_id;
    }

    public function setToken(string $token)
    {
        $this->token=$token;
    }

    public function JsonSerialize(){

        $user_arr=[
            'id' => $this->id,
            'idAgency'=>$this->agency_id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

        if ($this->token != '') {
            $user_arr["token"]=$this->token;
            $user_arr['roles']=$this->roles;
            $user_arr['permissions']=$this->permissions;
        }

        return $user_arr;
    }


    public function setRoles($roles)
    {
        $this->roles=$roles;
    }

    public function setPermissions($permissions)
    {
        $this->permissions=$permissions;
    }

    public function hasRoles($rolesSearch)
    {

        $hasRole=false;

        if(count($this->roles)>0){
            $roles=array_column($this->roles,"name");
            foreach($rolesSearch as $roleSearch){
                if(in_array($roleSearch,$roles)){
                    $hasRole=true;
                    break;
                }
            }
        }

        return $hasRole;

    }

    public function can($permissions)
    {




    }



}

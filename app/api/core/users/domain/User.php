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
    public string $roles="";


    public function getId()
    {
        return $this->id;
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
            'updated_at' => $this->updated_at,
            'roles'=>$this->roles
        ];

        if ($this->token != '') {
            $user_arr["token"]=$this->token;
        }

        return $user_arr;
    }


    public function setRoles($roles)
    {
        $this->roles=$roles;
    }


}

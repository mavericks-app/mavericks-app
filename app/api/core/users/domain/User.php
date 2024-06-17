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
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        if ($this->token != '') {
            $user_arr["token"]=$this->token;
        }

        return $user_arr;
    }



}

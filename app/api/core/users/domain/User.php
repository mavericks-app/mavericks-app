<?php

/*
Author: David
Fecha: 15/05/2024
*/


namespace App\api\core\users\domain;
use App\api\core\shared\contracts\domain\BaseDomain;


class User extends BaseDomain
{
    public int $id;
    public string $name;
    public string $email;
    public \DateTime $created_at;
    public \DateTime $updated_at;
    public string $token;
    public string $password;


    public function getId()
    {
        return $this->id;
    }

    public function setToken(string $token)
    {
        $this->token=$token;
    }

}

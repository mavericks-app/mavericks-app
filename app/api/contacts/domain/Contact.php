<?php

/*
Author: David
Fecha: 15/05/2024
*/

namespace App\api\contacts\domain;
use App\api\core\shared\contracts\domain\BaseDomain;


class Contact extends BaseDomain
{
    public int $id;
    public string $name;
    public string $lastName;
    public string $email;


    public function getId()
    {
        return $this->id;
    }


}

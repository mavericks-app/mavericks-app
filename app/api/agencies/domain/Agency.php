<?php

/*
Author: David
Fecha: 15/05/2024
*/

namespace App\api\agencies\domain;
use App\api\core\shared\contracts\domain\BaseDomain;


class Agency extends BaseDomain
{
    public int $id;
    public string $name;
    public string $agencyRole;
    public string $email;
    public string $phone;
    public string $address;
    public string $city;
    public string $website;

    public function getId()
    {
        return $this->id;
    }


}

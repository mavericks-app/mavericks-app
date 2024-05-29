<?php

/*
Author: David
Fecha: 15/05/2024
*/

namespace App\api\models\domain;
use App\api\core\shared\contracts\domain\BaseDomain;


class Model extends BaseDomain
{
    public int $id;
    public string $name;
    public string $email;


    public function getId()
    {
        return $this->id;
    }


}

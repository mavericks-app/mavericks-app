<?php

/*
Author: David
Fecha: 15/05/2024
*/



namespace  App\api\core\shared\contracts\domain;
use Shureban\LaravelObjectMapper\MappableTrait;

abstract class BaseDomain
{
    use MappableTrait;

    static function create($array)
    {
        return (new static())->mapFromArray($array);
    }

     static function createJson($json)
    {
        return (new static())->mapFromJson($json);
    }

    abstract  function getId();

}

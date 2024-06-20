<?php

/*
Author: David
Fecha: 20/05/2024
*/


namespace App\api\agencies\infrastructure;
use App\api\agencies\domain\Agency;
use App\api\core\shared\contracts\infrastructure\EloquentRepository;
use App\Models\Agency as ModelLaravel;


class AgencyRepository extends EloquentRepository
{
    public function __construct(ModelLaravel $model, Agency $modelDomain)
    {
        parent::__construct($model, $modelDomain);
    }

}

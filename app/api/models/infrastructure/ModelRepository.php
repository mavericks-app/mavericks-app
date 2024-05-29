<?php

/*
Author: David
Fecha: 20/05/2024
*/


namespace App\api\models\infrastructure;
use App\api\models\domain\Model;
use App\api\core\shared\contracts\infrastructure\EloquentRepository;
use App\api\core\shared\contracts\domain\BaseDomain;
use App\Models\Model as ModelApp;


class ModelRepository extends EloquentRepository
{
    public function __construct(ModelApp $model, Model $modelDomain)
    {
        parent::__construct($model, $modelDomain);
    }

}

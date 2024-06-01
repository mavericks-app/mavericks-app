<?php

/*
Author: David
Fecha: 20/05/2024
*/


namespace App\api\templates\infrastructure;
use App\api\templates\domain\Template;
use App\api\core\shared\contracts\infrastructure\EloquentRepository;
use App\Models\Template as ModelLaravel;


class TemplateRepository extends EloquentRepository
{
    public function __construct(ModelLaravel $model, Template $modelDomain)
    {
        parent::__construct($model, $modelDomain);
    }

}

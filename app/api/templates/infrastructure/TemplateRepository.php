<?php

/*
Author: David
Fecha: 20/05/2024
*/


namespace App\api\templates\infrastructure;
use App\api\templates\domain\Template;
use App\api\core\shared\contracts\infrastructure\EloquentRepository;
use App\api\core\shared\contracts\domain\BaseDomain;
use App\Models\Template as TemplateApp;


class TemplateRepository extends EloquentRepository
{
    public function __construct(TemplateApp $model, Template $modelDomain)
    {
        parent::__construct($model, $modelDomain);
    }

}

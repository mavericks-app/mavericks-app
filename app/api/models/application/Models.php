<?php

/*
Author: David
Fecha: 12/05/2024
*/
namespace App\api\models\application;

use App\api\core\shared\contracts\domain\BaseDomain;
use App\api\core\shared\contracts\application\BaseApplication;
use App\api\core\shared\contracts\domain\RepositoryBD;
use App\api\models\infrastructure\ModelRepository;
use App\api\models\domain\Model;


class Models extends BaseApplication
{

    protected ModelRepository $repository;
    protected  $domainClass;
    public function __construct(RepositoryBD $repository)
    {
        parent::__construct();
        $this->repository=$repository;
        $this->domainClass=Model::class;

    }

}

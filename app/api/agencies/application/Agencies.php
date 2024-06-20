<?php

/*
Author: David
Fecha: 12/05/2024
*/
namespace App\api\agencies\application;

use App\api\core\shared\contracts\domain\BaseDomain;
use App\api\core\shared\contracts\application\BaseApplication;
use App\api\core\shared\contracts\domain\RepositoryBD;
use App\api\agencies\infrastructure\AgencyRepository;
use App\api\agencies\domain\Agency;


class Agencies extends BaseApplication
{

    protected AgencyRepository $repository;
    protected  $domainClass;
    public function __construct(RepositoryBD $repository)
    {
        parent::__construct();
        $this->repository=$repository;
        $this->domainClass=Agency::class;

    }

}

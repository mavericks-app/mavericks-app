<?php

/*
Author: David
Fecha: 12/05/2024
*/
namespace App\api\templates\application;

use App\api\core\shared\contracts\domain\BaseDomain;
use App\api\core\shared\contracts\application\BaseApplication;
use App\api\core\shared\contracts\domain\RepositoryBD;
use App\api\templates\infrastructure\TemplateRepository;
use App\api\templates\domain\Template;


class Templates extends BaseApplication
{

    protected TemplateRepository $repository;
    protected  $domainClass;
    public function __construct(RepositoryBD $repository)
    {
        parent::__construct();
        $this->repository=$repository;
        $this->domainClass=Template::class;

    }

}

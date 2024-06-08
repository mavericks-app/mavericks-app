<?php

/*
Author: David
Fecha: 12/05/2024
*/
namespace App\api\contacts\application;

use App\api\core\shared\contracts\domain\BaseDomain;
use App\api\core\shared\contracts\application\BaseApplication;
use App\api\core\shared\contracts\domain\RepositoryBD;
use App\api\contacts\infrastructure\ContactRepository;
use App\api\contacts\domain\Contact;


class Contacts extends BaseApplication
{

    protected ContactRepository $repository;
    protected  $domainClass;
    public function __construct(RepositoryBD $repository)
    {
        parent::__construct();
        $this->repository=$repository;
        $this->domainClass=Contact::class;

    }

}

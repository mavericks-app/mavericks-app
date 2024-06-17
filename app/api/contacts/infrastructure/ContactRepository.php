<?php

/*
Author: David
Fecha: 20/05/2024
*/


namespace App\api\contacts\infrastructure;
use App\api\contacts\domain\Contact;
use App\api\core\shared\contracts\infrastructure\EloquentRepository;
use App\Models\Contact as ModelLaravel;


class ContactRepository extends EloquentRepository
{
    public function __construct(ModelLaravel $model, Contact $modelDomain)
    {
        parent::__construct($model, $modelDomain);
    }

    public function user()
    {
      return $this->model->user;
    }

}

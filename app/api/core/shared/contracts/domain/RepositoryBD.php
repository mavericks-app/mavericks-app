<?php

namespace App\api\core\shared\contracts\domain;
use App\api\core\shared\contracts\domain\BaseDomain;
use Illuminate\Support\Collection;


interface  RepositoryBD
{
     public function find($id):? BaseDomain;

     public function save(BaseDomain $domain):?BaseDomain;

     public function update(BaseDomain $domain ):? BaseDomain;

     public function remove($id): bool;

}

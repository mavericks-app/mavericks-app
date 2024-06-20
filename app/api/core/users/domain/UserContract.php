<?php

/*
Author: David
Fecha: 12/05/2024
*/


namespace App\api\core\users\domain;

interface UserContract
{
  public function getUser();
  public function autenticate($credentials);
  public function logout();
  public function getToken();

  public function getRoles(): array;

}

<?php

/*
Author: David
Fecha: 20/05/2024
*/


namespace App\api\core\shared\contracts\infrastructure;
use App\api\core\shared\contracts\application\BaseApplication;
use Illuminate\Http\Request;

interface CrudController
{
    public function store(Request $request);
    public function update(Request $request);

    public function remove(Request $request);

    public function index(Request $request);
}

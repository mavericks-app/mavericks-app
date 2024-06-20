<?php

/*
Author: David
Fecha: 20/06/2024
*/


namespace App\Enums;

enum Permissions: string{

    case AgencyList="list_agency";
    case AgencyCreate="create_agency";
    case AgencyEdit="edit_agency";
    case AgencyRemove="remove_agency";
}

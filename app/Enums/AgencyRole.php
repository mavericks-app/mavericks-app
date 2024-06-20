<?php
namespace App\Enums;


enum AgencyRole: string{

    case Admin="admin";
    case Client="client";
    case Fake="faker";
}

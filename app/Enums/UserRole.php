<?php
namespace App\Enums;


enum UserRole: string{

    case SuperAdmin="superadmin";
    case Admin="admin";
    case User="user";
    case Client="client";

}

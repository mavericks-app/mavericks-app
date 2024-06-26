<?php
namespace App\Enums;


enum UserRole: string{

    case SuperAdmin="superadmin";
    case Admin="admin";
    case User="user";
    case Client="client";


    public static function rolesString($separator=","): string
    {
        $arr=array_map(fn($role) => $role->value, self::cases());
        return implode($separator,$arr);
    }

}

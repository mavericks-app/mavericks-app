<?php
namespace App\Enums;


enum AgencyRole: string{

    case Admin="admin";
    case Client="client";
    case Fake="faker";

    public static function rolesString($separator=","): string
    {
        $arr=array_map(fn($role) => $role->value, self::cases());
        return implode($separator,$arr);
    }
}

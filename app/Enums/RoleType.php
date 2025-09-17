<?php

namespace App\Enums;

enum RoleType: int
{
    case SUPERADMIN = 1;
    case ADMIN = 2;
    case EMPLOYEE = 3;
    case ACCOUNTANT = 4;

    public function label(): string
    {
        return match($this) {
            self::SUPERADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
            self::EMPLOYEE => 'Employee',
            self::ACCOUNTANT => 'Accountant',
        };
    }
}

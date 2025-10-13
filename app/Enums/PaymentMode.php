<?php

namespace App\Enums;

enum PaymentMode: string
{
    const CASH = 1;
    const BANK = 2;
    const UPI  = 3;

    public static function getModes(): array
    {
        return [
            self::CASH => 'Cash',
            self::BANK => 'Bank',
            self::UPI  => 'UPI',
        ];
    }
}

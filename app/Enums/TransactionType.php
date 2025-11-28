<?php

namespace App\Enums;

enum TransactionType: string
{
    case CREDIT = 'income';
    case DEBIT = 'expense';
}

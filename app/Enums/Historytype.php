<?php

namespace App\Enums;

enum HistoryType: int
{
    const CREATED = 1;
    const UPDATED = 2;
    const DELETED = 3;
    const ASSIGNED = 4;
    const RETURNED = 5;
}

<?php

namespace App\Enums;

enum HistoryType: int
{
    const CREATED = 1;
    const UPDATED = 2;
    const DELETED = 3;
    const ASSIGNED = 4;
    const RETURNED = 5;

    public static function getColorClassByType($historyType)
    {
        switch ($historyType) {
            case self::CREATED:
                return 'alert-success';
            case self::UPDATED:
                return 'alert-primary';
            case self::DELETED:
                return 'alert-danger';
            case self::ASSIGNED:
                return 'alert-info';
            case self::RETURNED:
                return 'alert-warning';
            default:
                return 'alert-secondary';
        }
    }
}

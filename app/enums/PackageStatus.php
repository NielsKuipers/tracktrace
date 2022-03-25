<?php

namespace App\enums;

enum PackageStatus
{
    case LOGGED;
    case PRINTED;
    case DELIVERED;
    case SORTING;
    case SENT;
    case FINISHED;

    public function toString(): string
    {
        return match ($this) {
            self::LOGGED => 'logged',
            self::PRINTED => 'printed',
            self::DELIVERED => 'delivered',
            self::SORTING => 'sorting',
            self::SENT => 'sent',
            self::FINISHED => 'finished',
        };
    }

    public static function getRandom(): string
    {
        $arr = self::cases();
        return $arr[array_rand($arr)]->toString();
    }
}

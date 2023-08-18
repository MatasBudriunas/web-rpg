<?php

declare(strict_types=1);

namespace App\Constants;

final class BootConstants
{
    public const GREAVES = 'Greaves';
    public const SABATONS = 'Sabatons';
    public const PLATE_BOOTS = 'Plate Boots';
    public const LEATHER_BOOTS = 'Leather Boots';

    public const BOOTS = [
        self::GREAVES,
        self::SABATONS,
        self::PLATE_BOOTS,
        self::LEATHER_BOOTS,
    ];

    public static function getRandomBootsName(): string
    {
        return self::BOOTS[array_rand(self::BOOTS)];
    }
}

<?php

declare(strict_types=1);

namespace App\Constants;

class ArmorConstants
{
    public const PLATE_ARMOR = 'Plate Armor';
    public const CHAINMAIL = 'Chainmail';
    public const LEATHER_ARMOR = 'Leather Armor';
    public const SCALE_ARMOR = 'Scale Armor';
    public const CUIRASS = 'Cuirass';

    public const ARMORS = [
        self::PLATE_ARMOR,
        self::CHAINMAIL,
        self::LEATHER_ARMOR,
        self::SCALE_ARMOR,
        self::CUIRASS,
    ];

    public static function getRandomArmorName(): string
    {
        return self::ARMORS[array_rand(self::ARMORS)];
    }
}

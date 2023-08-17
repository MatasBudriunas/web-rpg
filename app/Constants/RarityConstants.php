<?php

declare(strict_types=1);

namespace App\Constants;

final class RarityConstants
{
    public const COMMON = 1;
    public const UNCOMMON = 1.2;
    public const RARE = 1.4;
    public const LEGENDARY = 2;

    public const MULTIPLIERS = [
        'common' => self::COMMON,
        'uncommon' => self::UNCOMMON,
        'rare' => self::RARE,
        'legendary' => self::LEGENDARY,
    ];
    public const RARITIES = [
        self::COMMON => 70,
        self::UNCOMMON => 20,
        self::RARE => 7,
        self::LEGENDARY => 3,
    ];

    public static function getMultiplier(float $rarity): float
    {
        return $rarity;
    }

    public static function getChance(float $rarity): int
    {
        return self::RARITIES[$rarity] ?? 0;
    }

    public static function getRarityName(float $multiplier): string
    {
        $name = array_search($multiplier, self::MULTIPLIERS);

        return ucfirst($name ?: 'common');
    }
}

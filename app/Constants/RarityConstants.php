<?php

declare(strict_types=1);

namespace App\Constants;

final class RarityConstants
{
    public const COMMON = 1;
    public const UNCOMMON = 2;
    public const RARE = 3;
    public const LEGENDARY = 4;

    public const COMMON_MULTIPLIER = 1;
    public const UNCOMMON_MULTIPLIER = 1.2;
    public const RARE_MULTIPLIER = 1.4;
    public const LEGENDARY_MULTIPLIER = 2;

    public const LEGENDARY_CHANCE = 3;
    public const RARE_CHANCE = 10;
    public const UNCOMMON_CHANCE = 30;

    public const RARITY_QUALITY_MAP = [
        self::COMMON => 1,
        self::UNCOMMON => 2,
        self::RARE => 3,
        self::LEGENDARY => 4,
    ];

    public static function getQuality(int $rarity): int
    {
        return self::RARITY_QUALITY_MAP[$rarity] ?? 1;
    }

    public static function getMultiplier(int $rarity): float
    {
        return match ($rarity) {
            self::COMMON => self::COMMON_MULTIPLIER,
            self::UNCOMMON => self::UNCOMMON_MULTIPLIER,
            self::RARE => self::RARE_MULTIPLIER,
            self::LEGENDARY => self::LEGENDARY_MULTIPLIER,
            default => 1,
        };
    }

    public static function getRandomRarity(): int
    {
        $randomNumber = rand(1, 100);

        if ($randomNumber <= self::LEGENDARY_CHANCE) {
            return self::LEGENDARY;
        } elseif ($randomNumber <= self::RARE_CHANCE) {
            return self::RARE;
        } elseif ($randomNumber <= self::UNCOMMON_CHANCE) {
            return self::UNCOMMON;
        } else {
            return self::COMMON;
        }
    }

    public static function getRarityName(int $rarity): string
    {
        return match ($rarity) {
            self::UNCOMMON => 'Uncommon',
            self::RARE => 'Rare',
            self::LEGENDARY => 'Legendary',
            default => 'Common',
        };
    }
}

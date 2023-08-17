<?php

declare(strict_types=1);

namespace App\Constants;

final class WeaponConstants
{
    public const SWORD = 'sword';
    public const DAGGER = 'dagger';
    public const BOW = 'bow';
    public const AXE = 'axe';
    public const POLEARM = 'polearm';

    public const WEAPONS = [
        self::SWORD,
        self::DAGGER,
        self::AXE,
        self::BOW,
        self::POLEARM
    ];

    public static function getRandomWeaponName(): string
    {
        return self::WEAPONS[array_rand(self::WEAPONS)];
    }
}

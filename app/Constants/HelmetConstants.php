<?php

declare(strict_types=1);

namespace App\Constants;

final class HelmetConstants
{
    public const HELM = 'Helm';
    public const VISOR = 'Visor';
    public const CASQUE = 'Casque';
    public const LEATHER_HAT = 'Leather Hat';

    public const HELMETS = [
        self::HELM,
        self::VISOR,
        self::CASQUE,
        self::LEATHER_HAT,
    ];

    public static function getRandomHelmetName(): string
    {
        return self::HELMETS[array_rand(self::HELMETS)];
    }
}

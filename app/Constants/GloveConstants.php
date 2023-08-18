<?php

declare(strict_types=1);

namespace App\Constants;

final class GloveConstants
{
    public const GAUNTLETS = 'Gauntlets';
    public const HANDGUARDS = 'Handguards';
    public const FINGERLESS_GLOVES = 'Fingerless Gloves';
    public const LEATHER_GLOVES = 'Leather Gloves';

    public const GLOVES = [
        self::GAUNTLETS,
        self::HANDGUARDS,
        self::FINGERLESS_GLOVES,
        self::LEATHER_GLOVES,
    ];

    public static function getRandomGloveName(): string
    {
        return self::GLOVES[array_rand(self::GLOVES)];
    }
}

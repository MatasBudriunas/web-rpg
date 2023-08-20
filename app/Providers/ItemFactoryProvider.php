<?php

declare(strict_types=1);

namespace App\Providers;

use App\Factories\ArmorFactory;
use App\Factories\BootFactory;
use App\Factories\GloveFactory;
use App\Factories\HelmetFactory;
use App\Factories\WeaponFactory;
use InvalidArgumentException;

class ItemFactoryProvider
{
    public static function getFactory(string $itemType): WeaponFactory|ArmorFactory|GloveFactory|HelmetFactory|BootFactory
    {
        switch ($itemType) {
            case 'weapon':
                return new WeaponFactory();
            case 'armor':
                return new ArmorFactory();
            case 'gloves':
                return new GloveFactory();
            case 'boots':
                return new BootFactory();
            case 'helmet':
                return new HelmetFactory();
        }

        throw new InvalidArgumentException("Invalid item type: $itemType");
    }
}

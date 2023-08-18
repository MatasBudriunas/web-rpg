<?php

declare(strict_types=1);

namespace App\Factories;

use App\Constants\WeaponConstants;

class WeaponFactory extends AbstractItemFactory implements ItemFactory
{
    protected function getItemName(): string
    {
        return WeaponConstants::getRandomWeaponName();
    }

    protected function getAttackMultiplier(): float
    {
        return 4;
    }

    protected function getDefenceMultiplier(): float
    {
        return 0.5;
    }

    protected function getHealthMultiplier(): float
    {
        return 0.5;
    }

    protected function getSpeedMultiplier(): float
    {
        return 1.5;
    }
}

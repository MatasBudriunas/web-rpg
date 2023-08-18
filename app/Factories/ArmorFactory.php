<?php

declare(strict_types=1);

namespace App\Factories;

use App\Constants\ArmorConstants;

class ArmorFactory extends AbstractItemFactory implements ItemFactory
{
    protected function getItemName(): string
    {
        return ArmorConstants::getRandomArmorName();
    }

    protected function getAttackMultiplier(): float
    {
        return 1;
    }

    protected function getDefenceMultiplier(): float
    {
        return 1.5;
    }

    protected function getHealthMultiplier(): float
    {
        return 2;
    }

    protected function getSpeedMultiplier(): float
    {
        return 1;
    }
}

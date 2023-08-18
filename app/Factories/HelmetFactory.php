<?php

declare(strict_types=1);

namespace App\Factories;

use App\Constants\HelmetConstants;

class HelmetFactory extends AbstractItemFactory implements ItemFactory
{
    protected function getItemName(): string
    {
        return HelmetConstants::getRandomHelmetName();
    }

    protected function getAttackMultiplier(): float
    {
        return 0.5;
    }

    protected function getDefenceMultiplier(): float
    {
        return 2;
    }

    protected function getHealthMultiplier(): float
    {
        return 1.5;
    }

    protected function getSpeedMultiplier(): float
    {
        return 1;
    }
}

<?php

declare(strict_types=1);

namespace App\Factories;

use App\Constants\GloveConstants;

class GloveFactory extends AbstractItemFactory implements ItemFactory
{
    protected function getItemName(): string
    {
        return GloveConstants::getRandomGloveName();
    }

    protected function getAttackMultiplier(): float
    {
        return 1;
    }

    protected function getDefenceMultiplier(): float
    {
        return 1.1;
    }

    protected function getHealthMultiplier(): float
    {
        return 1.1;
    }

    protected function getSpeedMultiplier(): float
    {
        return 1.5;
    }
}

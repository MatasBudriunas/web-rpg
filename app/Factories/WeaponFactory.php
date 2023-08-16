<?php

declare(strict_types=1);

namespace App\Factories;

use App\Constants\RarityConstants;
use App\Models\Item;
use App\Models\Weapon;

class WeaponFactory implements ItemFactory
{
    public function create(array $attributes): Item
    {
        $multiplier = RarityConstants::getMultiplier($attributes['rarity']);
        $level = $attributes['level'];

        $attributes['attack'] = $this->calculateAttack($multiplier, $level);
        $attributes['defence'] = $this->calculateDefence($multiplier, $level);
        $attributes['health'] = $this->calculateHealth($multiplier, $level);
        $attributes['speed'] = $this->calculateSpeed($multiplier, $level);

        return Weapon::create($attributes);
    }

    private function calculateAttack(float $multiplier, int $level): float
    {
        return round((rand(10, 50) + ($level * 2)) * $multiplier);
    }

    private function calculateDefence(float $multiplier, int $level): float
    {
        return round((rand(1, 5) + ($level)) * $multiplier);
    }

    private function calculateHealth(float $multiplier, int $level): float
    {
        return round((rand(1, 5) + ($level)) * $multiplier);
    }

    private function calculateSpeed(float $multiplier, int $level): float
    {
        return round((rand(5, 25) + ($level * 1.5)) * $multiplier);
    }
}

<?php

declare(strict_types=1);

namespace App\Factories;

use App\Constants\RarityConstants;
use App\Models\Item;

abstract class AbstractItemFactory
{
    abstract protected function getItemName(): string;
    abstract protected function getAttackMultiplier(): float;
    abstract protected function getDefenceMultiplier(): float;
    abstract protected function getHealthMultiplier(): float;
    abstract protected function getSpeedMultiplier(): float;

    public function create(array $attributes): Item
    {
        $rarityMultiplier = RarityConstants::getMultiplier($attributes['rarity']);
        $level = $attributes['level'];

        $itemName = $this->getItemName();
        $attributes['attack'] = $this->calculate($this->getAttackMultiplier(), $rarityMultiplier, $level);
        $attributes['defence'] = $this->calculate($this->getDefenceMultiplier(), $rarityMultiplier, $level);
        $attributes['health'] = $this->calculate($this->getHealthMultiplier(), $rarityMultiplier, $level);
        $attributes['speed'] = $this->calculate($this->getSpeedMultiplier(), $rarityMultiplier, $level);
        $attributes['name'] = RarityConstants::getRarityName($attributes['rarity']) . ' ' . ucfirst($itemName);

        return new Item($attributes);
    }

    private function calculate(float $itemMultiplier, float $rarityMultiplier, int $level): float
    {
        return round((rand(10, 15) + ($level * $itemMultiplier)) * $rarityMultiplier);
    }
}

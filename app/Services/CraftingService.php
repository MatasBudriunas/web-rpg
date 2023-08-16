<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\ItemTypeConstants;
use App\Constants\RarityConstants;

class CraftingService
{
    public function craftItem(){
        $itemRarity = $this->getRandomRarity();
        $itemType = $this->getRandomItemType();

        //TODO item crafting and replacement/equipment logic
    }

    private function getRandomRarity(): float {
        $randomNumber = rand(0, 100);
        $threshold = 0;

        foreach (RarityConstants::RARITIES as $rarity => $chance) {
            $threshold += $chance;
            if ($randomNumber < $threshold) {
                return $rarity;
            }
        }

        return RarityConstants::COMMON;
    }

    private function getRandomItemType(): string {
        $randomIndex = array_rand(ItemTypeConstants::ITEM_TYPES);

        return ItemTypeConstants::ITEM_TYPES[$randomIndex];
    }
}

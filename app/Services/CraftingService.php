<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\ItemTypeConstants;
use App\Constants\RarityConstants;
use App\Models\Item;
use App\Providers\ItemFactoryProvider;
use App\Repositories\UserRepository;
use Exception;

class CraftingService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function craftItem(int $userId): Item
    {
        $user = $this->userRepository->find($userId);

        if(!$user) {
            throw new Exception('No user provided');
        }

        $itemRarity = $this->getRandomRarity();
        $itemType = $this->getRandomItemType();
        $factory = ItemFactoryProvider::getFactory($itemType);

        $attributes = [
            'type' => $itemType,
            'rarity' => $itemRarity,
            'user_id' => $userId,
            'level' => $user->level
        ];

        return $factory->create($attributes);
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

<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\ItemTypeConstants;
use App\Constants\RarityConstants;
use App\Models\Item;
use App\Models\ItemLog;
use App\Models\User;
use App\Providers\ItemFactoryProvider;
use App\Repositories\UserRepository;
use Exception;

class CraftingService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function craftItem(int $userId): Item
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            throw new Exception('No user provided');
        }

        $itemRarity = RarityConstants::getRandomRarity();
        $itemType = $this->getRandomItemType();
        $factory = ItemFactoryProvider::getFactory($itemType);

        $attributes = $this->getAttributesData($itemType, $itemRarity, $userId, $user);

        $item = $factory->create($attributes);

        //TODO implement currency system and amounts
        $item->log_id = $this->logCraftedItem($item, $userId, 'gold', 1);

        return $item;
    }

    public function logCraftedItem(Item $item, int $userId, string $currencyType, int $currencyAmount): int
    {
        $craftLog = new ItemLog(array_merge($item->toArray(), [
            'user_id' => $userId,
            'currency_type' => $currencyType,
            'currency_amount' => $currencyAmount,
        ]));
        $craftLog->save();

        return $craftLog->id;
    }

    private function getRandomItemType(): string
    {
        $randomIndex = array_rand(ItemTypeConstants::ITEM_TYPES);

        return ItemTypeConstants::ITEM_TYPES[$randomIndex];
    }

    private function getAttributesData(string $itemType, int $itemRarity, int $userId, User $user): array
    {
        return [
            'type' => $itemType,
            'rarity' => $itemRarity,
            'user_id' => $userId,
            'level' => $user->level,
        ];
    }
}

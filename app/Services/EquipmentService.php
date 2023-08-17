<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Item;
use App\Models\ItemLog;
use App\Repositories\ItemLogRepository;
use App\Repositories\ItemRepository;

class EquipmentService
{
    private ItemRepository $itemRepository;
    private ItemLogRepository $itemLogRepository;
    public function __construct(
        ItemRepository $itemRepository,
        ItemLogRepository $itemLogRepository
    ) {
        $this->itemRepository = $itemRepository;
        $this->itemLogRepository = $itemLogRepository;
    }

    public function equipItem(int $itemLogId): Item
    {
        $itemLog = $this->itemLogRepository->find($itemLogId);

        $this->removeOldItem($itemLog);

        $attributes = $this->getItemAttributesData($itemLog);

        return $this->itemRepository->create($attributes);
    }

    public function getItemAttributesData(ItemLog $itemLog): array
    {
        return [
            'user_id' => $itemLog->user_id,
            'name' => $itemLog->name,
            'attack' => $itemLog->attack,
            'defence' => $itemLog->defence,
            'health' => $itemLog->health,
            'speed' => $itemLog->speed,
            'rarity' => $itemLog->rarity,
            'level' => $itemLog->level,
            'type' => $itemLog->type,
            'log_id' => $itemLog->id
        ];
    }

    private function removeOldItem(?ItemLog $itemLog): void
    {
        $oldItem = $this->itemRepository->findOneByMany([
            'user_id' => $itemLog->user_id,
            'type' => $itemLog->type,
        ]);

        if ($oldItem) {
            $this->itemRepository->delete($oldItem->id);
        }
    }
}

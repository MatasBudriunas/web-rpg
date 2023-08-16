<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;

class ItemRepository implements RepositoryInterface
{
    public function find(int $id): ?Item
    {
        return Item::find($id);
    }

    public function all(): Collection
    {
        return Item::all();
    }

    public function create(array $data): Item
    {
        return Item::create($data);
    }

    public function update(array $data, $id): Item
    {
        $user = Item::find($id);
        $user->update($data);

        return $user;
    }

    public function delete($id): void
    {
        Item::destroy($id);
    }

    public function findGroupedItemsByUser($userId): array
    {
        $items = Item::where('user_id', $userId)->get();

        $groupedItems = [];
        foreach ($items as $item) {
            $groupedItems[$item->item_type][] = $item;
        }

        return $groupedItems;
    }
}

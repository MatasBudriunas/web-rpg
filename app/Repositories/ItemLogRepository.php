<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ItemLog;
use Illuminate\Database\Eloquent\Collection;

class ItemLogRepository implements RepositoryInterface
{
    public function find(int $id): ?ItemLog
    {
        return ItemLog::find($id);
    }

    public function all(): Collection
    {
        return ItemLog::all();
    }

    public function create(array $data): ItemLog
    {
        return ItemLog::create($data)->first();
    }

    public function update(array $data, $id): ItemLog
    {
        $user = ItemLog::find($id);
        $user->update($data);

        return $user;
    }

    public function delete($id): void
    {
        ItemLog::destroy($id);
    }
}

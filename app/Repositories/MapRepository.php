<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Map;
use Illuminate\Database\Eloquent\Collection;

class MapRepository implements RepositoryInterface
{
    public function find(int $id): ?Map
    {
        return Map::find($id);
    }

    public function all(): Collection
    {
        return Map::all();
    }

    public function create(array $data): Map
    {
        return Map::create($data);
    }

    public function update(array $data, $id): Map
    {
        $user = Map::find($id);
        $user->update($data);

        return $user;
    }

    public function delete($id): void
    {
        Map::destroy($id);
    }
}

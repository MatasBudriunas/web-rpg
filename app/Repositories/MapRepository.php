<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Map;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

    public function findWith(int $id, string $relationName): Model|Collection|Builder|array|null
    {
        return Map::with($relationName)->find($id);
    }
}

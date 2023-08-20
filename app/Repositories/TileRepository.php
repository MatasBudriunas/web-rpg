<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Tile;
use Illuminate\Database\Eloquent\Collection;

class TileRepository implements RepositoryInterface
{
    public function find(int $id): ?Tile
    {
        return Tile::find($id);
    }

    public function all(): Collection
    {
        return Tile::all();
    }

    public function create(array $data): Tile
    {
        return Tile::create($data);
    }

    public function update(array $data, $id): Tile
    {
        $user = Tile::find($id);
        $user->update($data);

        return $user;
    }

    public function delete($id): void
    {
        Tile::destroy($id);
    }
}

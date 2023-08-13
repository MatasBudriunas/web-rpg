<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements RepositoryInterface
{
    public function find(int $id): ?User
    {
        return User::find($id);
    }

    public function all(): Collection
    {
        return User::all();
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(array $data, $id): User
    {
        $user = User::find($id);
        $user->update($data);

        return $user;
    }

    public function delete($id): void
    {
        User::destroy($id);
    }
}

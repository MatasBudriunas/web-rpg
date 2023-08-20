<?php

declare(strict_types=1);

namespace App\Repositories;

interface RepositoryInterface
{
    public function find(int $id);

    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete(int $id);
}

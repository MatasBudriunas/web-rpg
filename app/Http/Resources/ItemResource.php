<?php

declare(strict_types=1);

namespace App\Http\Resources;

class ItemResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'log_id' => $this->resource['log_id'] ?? null,
            'type' => $this->resource['type'] ?? null,
            'name' => $this->resource['name'] ?? null,
            'rarity' => $this->resource['rarity'] ?? null,
            'level' => $this->resource['level'] ?? null,
            'attack' => $this->resource['attack'] ?? null,
            'defence' => $this->resource['defence'] ?? null,
            'health' => $this->resource['health'] ?? null,
            'speed' => $this->resource['speed'] ?? null,
            'user_id' => $this->resource['user_id'] ?? null,
        ];
    }
}

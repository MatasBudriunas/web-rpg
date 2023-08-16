<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'type' => $this->type,
            'name' => $this->name,
            'rarity' => $this->rarity,
            'level' => $this->level,
            'attack' => $this->attack,
            'defence' => $this->defence,
            'health' => $this->health,
            'speed' => $this->speed,
            'user_id' => $this->user_id,
        ];
    }
}

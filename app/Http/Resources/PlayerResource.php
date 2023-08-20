<?php

declare(strict_types=1);

namespace App\Http\Resources;

class PlayerResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'username' => $this->username,
            'attack' => $this->attack,
            'defence' => $this->defence,
            'health' => $this->health,
            'speed' => $this->speed,
            'current_xp' => $this->current_xp,
            'needed_xp' => $this->needed_xp,
            'level' => $this->level,
            'currency' => $this->currency,
            'coordinates_x' => $this->coordinates_x,
            'coordinates_y' => $this->coordinates_y,
            'map_id' => $this->map_id,
            'map' => $this->map->name,
            'map_width' => $this->map->width,
            'map_height' => $this->map->height,
        ];
    }
}

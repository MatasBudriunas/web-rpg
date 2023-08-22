<?php

namespace App\Http\Resources;

class TileResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'map_id' => $this->map_id,
            'coordinates_x' => $this->coordinates_x,
            'coordinates_y' => $this->coordinates_y,
            'type' => $this->type,
            'is_passable' => $this->is_passable,
            'encounters_enabled' => $this->encounters_enabled,
            'special_feature_type' => $this->special_feature_type,
            'special_feature_data' => $this->special_feature_data,
        ];
    }
}

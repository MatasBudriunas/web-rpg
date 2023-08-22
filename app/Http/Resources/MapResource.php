<?php

namespace App\Http\Resources;

class MapResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'map' => $this->name,
            'width' => $this->width,
            'height' => $this->height,
            'tiles' => TileResource::collection($this->tiles),
        ];
    }
}

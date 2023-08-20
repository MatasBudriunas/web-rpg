<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tile extends Model
{
    protected $fillable = [
        'map_id',
        'coordinates_x',
        'coordinates_y',
        'type',
        'is_passable',
        'encounters_enabled',
        'special_feature_type',
        'special_feature_data',
    ];

    public function map(): BelongsTo
    {
        return $this->belongsTo(Map::class);
    }
}

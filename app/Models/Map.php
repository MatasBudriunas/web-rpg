<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Map extends Model
{
    protected $fillable = [
        'name',
        'width',
        'height',
    ];

    public function tiles(): HasMany
    {
        return $this->hasMany(Tile::class);
    }
}

<?php

declare(strict_types=1);

namespace App\Models;

/**
 * @method static create(array $attributes)
 */
class Weapon
{
    protected $fillable = [
        'user_id',
        'type',
        'name',
        'rarity',
        'level',
        'attack',
        'defence',
        'health',
        'speed',
    ];
}

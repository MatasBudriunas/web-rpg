<?php

declare(strict_types=1);

namespace App\Models;

class Gloves
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

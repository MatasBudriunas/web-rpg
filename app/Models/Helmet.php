<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Helmet extends Model
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

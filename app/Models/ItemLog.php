<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $id
 * @property mixed $user_id
 * @property mixed $name
 * @property mixed $attack
 * @property mixed $defence
 * @property mixed $health
 * @property mixed $speed
 * @property mixed $rarity
 * @property mixed $level
 * @property mixed $type
 */
class ItemLog extends Model
{
    protected $table = 'item_logs';
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'attack',
        'defence',
        'health',
        'speed',
        'rarity',
        'level',
        'currency_type',
        'currency_amount',
    ];
}

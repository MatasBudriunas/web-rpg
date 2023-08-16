<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find($id)
 * @method static create(array $data)
 * @method static where(string $string, $userId)
 */
class Item extends Model
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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

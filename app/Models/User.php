<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static create(array $array)
 * @property mixed $level
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'attack',
        'defence',
        'health',
        'speed',
        'remember_token',
        'current_xp',
        'needed_xp',
        'level',
        'currency',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function map(): BelongsTo
    {
        return $this->belongsTo(Map::class);
    }

    public function addXP($xp) {
        $this->current_xp += $xp;

        while ($this->current_xp >= $this->needed_xp) {
            $this->level++;
            $this->current_xp -= $this->needed_xp;
            $this->needed_xp = 10 * $this->level;
        }
        $this->save();
    }
}

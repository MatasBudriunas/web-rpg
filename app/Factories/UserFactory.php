<?php

declare(strict_types=1);

namespace App\Factories;

use App\Constants\UserConstants;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserFactory
{
    public function create(array $data): User
    {
        return User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'attack' => UserConstants::DEFAULT_ATTACK,
            'defence' => UserConstants::DEFAULT_DEFENCE,
            'health' => UserConstants::DEFAULT_HEALTH,
            'speed' => UserConstants::DEFAULT_SPEED,
            'map_id' => UserConstants::DEFAULT_MAP,
            'coordinates_x' => UserConstants::DEFAULT_X_COORDINATE,
            'coordinates_y' => UserConstants::DEFAULT_Y_COORDINATE
        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends Controller
{
    public function getPlayer(Request $request)
    {
        $user = $request->user();

        $player = [
            'username' => $user->username,
            'attack' => $user->attack,
            'defence' => $user->defence,
            'health' => $user->health,
            'speed' => $user->speed,
            'current_xp' => $user->current_xp,
            'needed_xp' => $user->needed_xp,
            'level' => $user->level,
            'currency' => $user->currency,
        ];

        return response()->json($player, Response::HTTP_OK);
    }
}
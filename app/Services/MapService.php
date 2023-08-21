<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\TileRepository;
use Exception;

class MapService
{
    private TileRepository $tileRepository;

    public function __construct(TileRepository $tileRepository)
    {
        $this->tileRepository = $tileRepository;
    }

    /**
     * @throws Exception
     */
    public function movePlayer(int $coordinatesX, int $coordinatesY, int $mapId, User $user): array
    {
        $location = $this->tileRepository->findOneByMany([
            'map_id' => $mapId,
            'coordinates_x' => $coordinatesX,
            'coordinates_y' => $coordinatesY
        ]);

        if (!$location) {
            throw new Exception('Invalid movement location');
        }

        $this->updateUserLocation($mapId, $user, $coordinatesX, $coordinatesY);

        return [
            'x' => $coordinatesX,
            'y' => $coordinatesY,
        ];
    }

    public function updateUserLocation(int $mapId, User $user, int $coordinatesX, int $coordinatesY): void
    {
        $user->map_id = $mapId;
        $user->coordinates_x = $coordinatesX;
        $user->coordinates_y = $coordinatesY;
        $user->save();
    }
}

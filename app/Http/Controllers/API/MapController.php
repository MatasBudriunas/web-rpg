<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MapResource;
use App\Repositories\MapRepository;
use Illuminate\Http\Request;

class MapController extends Controller
{
    private MapRepository $mapRepository;

    public function __construct(MapRepository $mapRepository){
        $this->mapRepository = $mapRepository;
    }

    public function getMap(Request $request): MapResource
    {
        $map = $this->mapRepository->findWith((int) $request->get('map_id'), 'tiles');

        return new MapResource($map);
    }
}
